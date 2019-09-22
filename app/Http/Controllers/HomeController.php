<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quiz;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $upQuiz = Quiz::where('start_on','>=',Carbon::today()->toDateString())
                            ->get();
        $prvQuiz = Quiz::where('start_on','<',Carbon::today()->toDateString())
                            //->get();
                            ->paginate(10);                    
        //return $quiz;
        return view('user.index')->with(['UpQuiz'=>$upQuiz,'prevQuiz'=>$prvQuiz]);
    }
}
