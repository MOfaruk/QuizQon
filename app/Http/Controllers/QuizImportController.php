<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;
use App\Imports\QuizImport;
use App\Quiz;
use App\Question;
use Auth;
use Illuminate\Database\QueryException;

class QuizImportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.import_quiz_create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$msg = []; //TBD
        $validator1 = $request->validate([
              
            'qz_nQs' => 'required|numeric|max:200',
            //'qz_neg' => 'required|min:0|max:1',   
            //'quiz_file' => 'required|mimes:xls,xlsx', this doesnt work for some cases, specially for those
            //files created with libreoffice 

        ]);

        $validator2 =$request->validate(
            [
                'file'      => $request->file('quiz_file'),
                'extension' => strtolower($request->file('quiz_file')->getClientOriginalExtension()),
            ],
            [
                'file'          => 'required',
                'extension'      => 'required|in:xlsx,xls',
            ]
          );

        $allSheet = Excel::toArray(new QuizImport,$request->file('quiz_file'));        
        $sheet = $allSheet[0]; // only from sheet 1
        $nRow = count($sheet);
        //TBD return with msg if nRow=0
        $quiz = Quiz::findOrFail($request->quiz_id);
        //$quiz->title = $request->qz_title;
        //$quiz->desc = $request->qz_desc;
        $quiz->nQs = $request->qz_nQs;
        //$quiz->negativeMark = $request->qz_neg;
        //$quiz->author_id = Auth::user()->id;
        //$quiz->start_on = $request->qz_start_on;
        //$quiz->duration = $request->qz_duration;
        $quiz->save();
        
        //$nQes = $request->qz_nQs;

        for($i=1; $i < $nRow; $i++) //first row is  for title
        {            
            $question = new Question();
            $question->quiz_id = $request->quiz_id;
            $question->desc = $sheet[$i][0];
            $question->option1 = $sheet[$i][1];
            $question->option2 = $sheet[$i][2];
            $question->option3 = $sheet[$i][3];
            $question->option4 = $sheet[$i][4];
            $question->correct = $sheet[$i][5];
            try {
                $question->save();
            } catch(QueryException $e) {
                //rolling back
                Question::where('quiz_id', $request->quiz_id)->delete();
                $quiz->delete();
                //TBD notify user
            }
            
        }
        //TBD success redireect to edit page
        //array_push($msg,["type"=>"success","msg"=>"Questions have been successully imported"]);
        return back();//->with("msg",$msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
