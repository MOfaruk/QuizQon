<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Quiz;
use App\Question;
use App\Answer;
use Auth;
use \Carbon\Carbon;
use \Illuminate\Pagination\Paginator;

class UserQuizController extends Controller
{
    public function showQuizDescription($id)
    {
        $quiz = Quiz::where('id',$id)
                        ->get();
        return view('user.quiz.description')->with('quiz',$quiz[0]);
    }
    public function show($id)
    {
        $quiz = Quiz::findOrFail($id);
        return view('user.quiz.arena')->with('quiz',$quiz);
    }

    public function getquiz($id)
    {
        $quiz = Quiz::where('id',$id)
                    ->get();
        if($quiz->count())
        {
            $diff = Carbon::parse($quiz[0]->start_on)->diffInSeconds(Carbon::now('UTC'),false);
            // diff = quizTime - now 
            // before quiz diff -ve, after start +ve
            $ans = Answer::where('quiz_id',$id)
                            ->where('user_id',Auth::id())
                            ->get();
            
            if( $diff < 0) // quiz is not running
                return [
                    'quiz'=>array(),
                    'waitTime'=>$diff*(-1),
                    'duration' => '',
                    'date'=>$quiz[0]->start_on,
                    'msgCode'=>'100',
                    'msg'=>'quiz will start soon',
                    'prev'=>$ans->count()
                ];
            //else
            $question = Question::where('quiz_id',$id)
                                ->get();
            if($quiz[0]->nQs != $question->count())
                \Log::warning('UserQuizController:55 - Quiz->nQs not equal to number of question pick from Question.'.$quiz[0]->nQs .'!='. $question->count());
            
            return [
                'quiz'=>$question,
                'waitTime'=>$diff*(-1),
                'duration' => $quiz[0]->duration,
                'date'=>$quiz[0]->start_on,
                'msgCode'=>'101',
                'msg'=>'quiz running',
                'prev'=>$ans->count()
            ];  
        }
        else
         return ['msgCode'=>'102','msg'=>'quiz not found'];

             
    }

    public function submitquiz(Request $request, $id)
    {
        $data = $request->data;        
        $ans = array();
        parse_str($data, $ans);
        $question = Question::where('quiz_id',$id)
                            ->get();
        
        $quiz = Quiz::findOrFail($id);
        $nQs = $quiz->nQs;
        $ansArray = array();
        $correct = 0;
        $wrong = 0;
        $unattempted = 0;

        for($i=1; $i<=$nQs; $i++)
        {
            if(isset($ans['qs_'.$i]))
                $ansTemp = $ans['qs_'.$i];
            else
                $ansTemp = -1; //not tried

            //answer matching
            if($ansTemp == -1)
                $unattempted++;
            else if($ansTemp == $question[$i-1]->correct)
                $correct++;
            else
                $wrong++;

            array_push($ansArray,array('qsId'=>$question[$i-1]->id,'ans'=>$ansTemp));
        }
        //calculating score
        $score = $correct - ($wrong * $quiz->negativeMark);

        try {
            $answer = new Answer();
            $answer->user_id = Auth::user()->id;
            $answer->quiz_id = $id;
            $answer->correct = $correct;
            $answer->wrong = $wrong;
            $answer->unattempted = $unattempted;
            $answer->score = $score;
            $answer->solve_time = $request->solveTime;
            $answer->ans_json = json_encode($ansArray);
            $answer->user_ip = request()->ip();
            $answer->save();

            $msgcode = '1000';
            $msg = "answers successfully submitted";
        } catch ( \Illuminate\Database\QueryException $ex) {
            //return $ex->getCode();
            $msgcode = $ex->errorInfo[1];
            $msg = $ex->getMessage();
        }        

        return ['msg'=>$msg,'msgCode'=>$msgcode];
    }

    public function scoreboard(Request $request, $id)
    {
        $quiz = Quiz::findOrFail($id);

        //$diff = Carbon::parse($quiz->start_on)->diffInSeconds(Carbon::now('UTC'),false);
        //return $diff;
        /*
        if( $diff < 0)
            return $this->showPendingScore($request,$quiz);
        else
            return $this->showFinalScore($request,$quiz);
        */
        $quiz_end = Carbon::parse($quiz->start_on)
                            ->addMinutes($quiz->duration)
                            ->addSeconds(35)//add seconds for safety
                            ->timezone('UTC');
        $viewData = DB::table('answers')
                ->rightJoin('users','users.id','=','answers.user_id')
                ->where('answers.quiz_id',$quiz->id)
                ->where('answers.created_at','<',$quiz_end)
                ->orderBy('score','desc')                
                ->orderBy('solve_time','asc')
                ->select('users.id','name','score','correct','wrong','unattempted','solve_time')
                ->paginate(25);
                //->get(['users.id','users.name','answers.score','answers.correct','answers.wrong','answers.unattempted']);
                //->paginate(5,['id','name','username'.....]);
                //->get();
        //return $viewData;
        if(Carbon::parse($quiz->start_on)->greaterThan(Carbon::now('UTC')) )//before quiz start
            return view('user.quiz.scoreboard',['score'=>[],'quiz'=>$quiz,'bFinalScore'=>false]);
        else if($quiz_end->greaterThan(Carbon::now('UTC')))//quiz running
            return view('user.quiz.scoreboard',['score'=>$viewData,'quiz'=>$quiz,'bFinalScore'=>false]);
        else //finished
            return view('user.quiz.scoreboard',['score'=>$viewData,'quiz'=>$quiz,'bFinalScore'=>true]);

        
    }

    public function showPendingScore(Request $request, $quiz)
    {
        if($request->input('page')== -1) // -1 for user position page
        {
            $ans =  DB::table('answers')
                        ->where('quiz_id',$quiz->id)
                        ->where('user_id',Auth::user()->id)
                        ->get();
            $ansId =  $ans[0]->id;

            $myAnsIndex = DB::table('answers')
                            ->where('quiz_id',$quiz->id)
                            ->where('id','<=',$ansId)
                            ->get()
                            ->count();
                            //->pluck('quiz_id')->search('1');

            $currentPage = ceil($myAnsIndex/2); 
            Paginator::currentPageResolver(function() use ($currentPage) { 
                return $currentPage; 
            });
            
            //return $currentPage;
        }
        //        
        $score = DB::table('answers')
                ->rightJoin('users','users.id','=','answers.user_id')
                ->where('answers.quiz_id',$quiz->id)
                //->orderBy('score','desc')
                ->select('users.name','answers.score','answers.correct','answers.wrong','answers.unattempted')
                ->paginate(25);
                //->get(['users.name','answers.score','answers.correct','answers.wrong','answers.unattempted']);
                //->paginate(5,['id','name','username'.....]);
        return view('user.quiz.scoreboard')->with(['score'=>$score,'size'=>0/*$score->count()*/,'quiz'=>$quiz ]);
    }

    public function showFinalScore(Request $request, $quiz)
    {
        /*
        $score = DB::table('answers')
                ->rightJoin('users','users.id','=','answers.user_id')
                ->where('answers.quiz_id',$quiz->id)
                ->orderBy('score','desc')
                //->select('users.name','answers.score','answers.correct','answers.wrong','answers.unattempted')
                //->paginate(2);
                ->get(['users.id','users.name','answers.score','answers.correct','answers.wrong','answers.unattempted']);
                //->paginate(5,['id','name','username'.....]);
                //->get();
        */
        //return $quiz;
                
        if($request->input('page')== -1) // -1 for user position page
        {
            
            $score = DB::table('answers')
            //->rightJoin('users','users.id','=','answers.user_id')
            ->where('quiz_id',$quiz->id)
            ->orderBy('score','desc')
            ->orderBy('solve_time','asc')
            //->select('users.name','answers.score','answers.correct','answers.wrong','answers.unattempted')
            //->paginate(2);
            //->get(['users.id','users.name','answers.score','answers.correct','answers.wrong','answers.unattempted']);
            //->paginate(5,['id','name','username'.....]);
            ->get();


            $myAnsIndex=-1;
            foreach ($score as $key => $sc) 
            {
                if($sc->user_id == Auth::user()->id)
                {
                    $myAnsIndex = $key;
                    break;
                }
            };

            $currentPage = ceil($myAnsIndex/2); 
            Paginator::currentPageResolver(function() use ($currentPage) { 
                return $currentPage; 
            });
            
            //return $currentPage." ".$myAnsIndex;
        }
        
        $viewData = DB::table('answers')
                ->rightJoin('users','users.id','=','answers.user_id')
                ->where('answers.quiz_id',$quiz->id)
                ->orderBy('score','desc')                
                ->orderBy('solve_time','asc')
                ->select('users.id','name','score','correct','wrong','unattempted','solve_time')
                ->paginate(25);
                //->get(['users.id','users.name','answers.score','answers.correct','answers.wrong','answers.unattempted']);
                //->paginate(5,['id','name','username'.....]);
                //->get();
        //return $viewData;
        
        return view('user.quiz.scoreboard')->with(['score'=>$viewData,'quiz'=>$quiz]);


    }

    public function showScore($qzId)
    {
        $question = Question::where('quiz_id',$qzId)
                            ->get(['desc','option1','option2','option3','option4','correct']);
        //check if user already submitted
        $answer = Answer::where('quiz_id',$qzId)
                        ->where('user_id',Auth::id())
                        ->get();
        if($answer->count())
            return ['questions'=>$question,'answer'=>$answer];
        return [];
    }

    public function solution($id, $title = NULL)
    {   
        $quiz = Quiz::findOrFail($id);
        $quiz_end = Carbon::parse($quiz->start_on)->addMinutes($quiz->duration);
        if( Carbon::now('UTC')->greaterThan($quiz_end) )// quiz finished
        {
            $bUserAns = request()->bUserAns;
            $userAns = [];
            if($bUserAns)
            {
                $ans = Answer::where('quiz_id',$id)
                                    ->where('user_id',Auth::id())
                                    ->first();
                if($ans)
                    $userAns = json_decode($ans->ans_json);
            }
            
            $qsWithAns = Question::where('quiz_id',$id)
                                ->get();            
            
            return view('user.quiz.solution',[
                'qsWithAns'=>$qsWithAns,
                'quiz'=>$quiz,
                'bUserAns'=>$bUserAns,
                'userAns'=>$userAns
                ]);
        }     
        
        //return without qs Ans
        return view('user.quiz.solution',[
            'qsWithAns'=>[],
            'quiz'=>$quiz,
            'bUserAns'=>request()->bUserAns,
            'userAns'=>NULL
            ]);
}
}
