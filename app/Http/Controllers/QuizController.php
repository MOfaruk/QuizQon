<?php

namespace App\Http\Controllers;

use App\Quiz;
use App\Question;
use Illuminate\Http\Request;
use \Carbon\Carbon;
use Auth;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quizzes = Quiz::orderBy('id','desc')
                        ->paginate(2);
        return view('admin.quiz_all',['quizzes'=>$quizzes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.quiz_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //TBD REQUEST VALIDATION

        $quiz = new Quiz();
        $quiz->title = $request->qz_title;
        $quiz->desc = $request->qz_desc;
        $quiz->nQs = 0;//$request->qz_nQs;
        $quiz->author_id = Auth::user()->id;        
        $quiz->start_on = Carbon::parse($request->qz_start_on, 'Asia/Dhaka')->setTimezone('UTC');;
        $quiz->duration = $request->qz_duration;
        $quiz->thumbnail = "thumb-".rand(1,9).".jpeg";
        $quiz->save();
        /*
        $nQes = $request->qz_nQs;
        for($i=1;$i<=$nQes;$i++)
        {            
            $question = new Question();
            $question->quiz_id = $quiz->id;
            $question->desc = $request->input("qsDesc_".$i);
            $question->option1 = $request->input("qs_".$i."_op_1");
            $question->option2 = $request->input("qs_".$i."_op_2");
            $question->option3 = $request->input("qs_".$i."_op_3");
            $question->option4 = $request->input("qs_".$i."_op_4");
            $question->correct = $request->input("ans_".$i);
            $question->save();
            
        }
        */

        //return redirect()->route('your_url_where_you_want_to_redirect');
        //return Quiz::all();
        //return view('admin.quiz_edit',['quiz'=>$quiz,'questions'=>[],'tab'=>'second']);
        return redirect(route('admin.quiz.edit',$quiz));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function show(Quiz $quiz)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function edit(Quiz $quiz)
    {
        return view('admin.quiz_edit',['quiz'=>$quiz,'questions'=>[],'tab'=>'second']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quiz $quiz)
    {
        $quiz = Quiz::findOrFail($quiz->id);
        $quiz->title = $request->qz_title;
        $quiz->desc = $request->qz_desc;
        $quiz->start_on = Carbon::parse($request->qz_start_on, 'Asia/Dhaka')->setTimezone('UTC');
        $quiz->duration = $request->qz_duration;
        $quiz->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Quiz  $quiz
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quiz $quiz)
    {
        //
    }
}
