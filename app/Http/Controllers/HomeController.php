<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quiz;
use App\Answer;
use App\User;
use App\UserInfo;
use Auth;
use Carbon\Carbon;
use UserDashboardController;

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
        $upQuiz = Quiz::where('start_on','>=',Carbon::now('UTC'))
                        ->orderBy('start_on','asc')
                        //->get();
                        ->paginate(10);

        $prvQuiz = Quiz::where('start_on','<',Carbon::now('UTC'))
                        //->get();
                        ->paginate(10);
        //Recent Quizzes user missed
        $perticipated = Answer::where('user_id',Auth::id())
                                ->pluck('quiz_id');
        $quizIds = json_decode($perticipated,true);
        $recentQuiz = Quiz::where('start_on','<',Carbon::now('UTC'))
                            ->whereNotIn('id',$quizIds)
                            ->orderBy('start_on','DESC')
                            ->paginate(10);                
        //dd( $recentQuiz);
        return view('user.index')->with(['UpQuiz'=>$upQuiz,'prevQuiz'=>$prvQuiz,'recentQuiz'=>$recentQuiz]);
    }

    public function showUserProfile($id)
    {   if(Auth::id()==$id)
            return redirect(route('dashboard.index'));
        $acc = User::find($id);
        $personal = $this->getPersonalInfo($id);
        $bFriend = Auth::user()->isFriend($id); //check if is friend of user
        return view('user.dashboard.home',['account'=>$acc,'personalInfo'=>$personal,'anonymous'=>true,'bFriend'=>$bFriend]);
    }

    public function getPersonalInfo($id) // copied from UserDashboardController
    {
        $pInfo = UserInfo::where('user_id','=',$id)->get();//->first();        
        //dd($decoded1->dob);
        if(count($pInfo))
        {
            $decoded = json_decode($pInfo[0]);
            $personal = json_decode($decoded->info,true);
        }                        
        else
            $personal = [
                'institute' => '',
                'level' => '',
                'dob' => '',
                'present' => '',
                'permanent' => '',
            ];
        return $personal;
    }

    public function search($term=NULL)
    {
        if($term == NULL)
            $term = request()->get('query');

        $quizzes = Quiz::where('title','LIKE','%'.$term.'%')->paginate(15);
        return view('user.quizlist',['quizzes'=>$quizzes]);
    }
}
