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

class QuizControllerUser extends Controller
{
    public function show($id)
    {
        $quiz = Quiz::where('id',$id)
                        ->get();
        //return $quiz;
        if($quiz->isEmpty())
            return view('404');

        $diff = Carbon::parse($quiz[0]->start_on)->diffInSeconds(Carbon::now()->toDateString());

        return view('user.quiz')->with('quiz',$quiz[0]);
    }

    public function getquiz($id)
    {
        $quiz = Quiz::where('id',$id)
                    ->get();
        if($quiz->count())
        {
            $diff = Carbon::parse($quiz[0]->start_on)->diffInSeconds(Carbon::now(),false);
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
        
        $nQs = $question->count();
        $ansArray = array();
        $correct = 0;
        $wrong = 0;
        $unattempted = 0;

        for($i=1; $i<=$nQs; $i++)
        {
            if(isset($ans['qs_'.$i]))
                $ansTemp = $ans['qs_'.$i];
            else
                $ansTemp = 0;

            //answer matching
            if($ansTemp == 0)
                $unattempted++;
            else if($ansTemp == $question[$i-1]->correct)
                $correct++;
            else
                $wrong++;

            array_push($ansArray,array('qsId'=>$question[$i-1]->id,'ans'=>$ansTemp));
        }

        //calculating score
        $score = $correct - ($wrong * 0.25);

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
        $quiz = Quiz::where('id',$id)
                    ->get();
        if($quiz->count())
        {
            $diff = Carbon::parse($quiz[0]->start_on)->diffInSeconds(Carbon::now()->toDateString());
            if( $diff < 60)
                return $this->showPendingScore($request,$id);
            else
                return $this->showFinalScore($request,$id);
        }
        
    }

    public function showPendingScore(Request $request, $quiz_id)
    {
        if($request->input('page')== -1) // -1 for user position page
        {
            $ans =  DB::table('answers')
                        ->where('quiz_id',$quiz_id)
                        ->where('user_id',Auth::user()->id)
                        ->get();
            $ansId =  $ans[0]->id;

            $myAnsIndex = DB::table('answers')
                            ->where('quiz_id',$quiz_id)
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
                ->where('answers.quiz_id',$quiz_id)
                //->orderBy('score','desc')
                ->select('users.name','answers.score','answers.correct','answers.wrong','answers.unattempted')
                ->paginate(2);
                //->get(['users.name','answers.score','answers.correct','answers.wrong','answers.unattempted']);
                //->paginate(5,['id','name','username'.....]);
        return view('user.scoreboard')->with(['score'=>$score,'size'=>0/*$score->count()*/]);
    }

    public function showFinalScore(Request $request, $quiz_id)
    {
        /*
        $score = DB::table('answers')
                ->rightJoin('users','users.id','=','answers.user_id')
                ->where('answers.quiz_id',$quiz_id)
                ->orderBy('score','desc')
                //->select('users.name','answers.score','answers.correct','answers.wrong','answers.unattempted')
                //->paginate(2);
                ->get(['users.id','users.name','answers.score','answers.correct','answers.wrong','answers.unattempted']);
                //->paginate(5,['id','name','username'.....]);
                //->get();
        */
                
        if($request->input('page')== -1) // -1 for user position page
        {
            
            $score = DB::table('answers')
            //->rightJoin('users','users.id','=','answers.user_id')
            ->where('quiz_id',$quiz_id)
            ->orderBy('score','desc')
            ->orderBy('solve_time','asc')
            //->select('users.name','answers.score','answers.correct','answers.wrong','answers.unattempted')
            //->paginate(2);
            //->get(['users.id','users.name','answers.score','answers.correct','answers.wrong','answers.unattempted']);
            //->paginate(5,['id','name','username'.....]);
            ->get();


            $myAnsIndex;
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
                ->where('answers.quiz_id',$quiz_id)
                ->orderBy('score','desc')                
                ->orderBy('solve_time','asc')
                ->select('users.id','name','score','correct','wrong','unattempted','solve_time')
                ->paginate(2);
                //->get(['users.id','users.name','answers.score','answers.correct','answers.wrong','answers.unattempted']);
                //->paginate(5,['id','name','username'.....]);
                //->get();
        //return $viewData;
        
        return view('user.scoreboard')->with(['score'=>$viewData]);


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
}
