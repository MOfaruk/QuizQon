<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
use App\User;
use App\UserInfo;
use Auth;
use DB;
use Hash;

class UserDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pInfo = UserInfo::where('user_id','=',Auth::user()->id)->first();//->get();
        $personal = $this->getPersonalInfo(Auth::user()->id);
        return view('user.dashboard.home',['personalInfo'=>$personal]);
    }

    public function getUserScores($id)
    {
        $scores = Answer::where('user_id',$id)
                            ->orderBy('created_at','asc')
                            ->get();
        $total = $scores->count();

        $sumFullScore = 0;
        $sumGetScore = 0;
        $i=0;
        $scr=[];
        foreach($scores as $score)
        {
            $fullScore = $score["correct"]+$score["wrong"]+$score["unattempted"];
            $date = date("d-m-y",strtotime( $score["created_at"]));

            array_push($scr, ["date"=>$date,"rScore"=>($score["score"]*100/(float)$fullScore)]);

            
            $sumFullScore += $fullScore;
            $sumGetScore += $score["score"];

            if($i>=10)
                break;
            $i++;
        }
        if($sumFullScore>0)
            $avg = $sumGetScore*100/(float)$sumFullScore;
        else
            $avg = 0;

        return ["scores"=>$scr,"avg"=>$avg,"total"=>$total];
    }

    /**
     * Display a listing of user quizzes.
     *
     * @return \Illuminate\Http\Response
     */
    public function showQuizzes()
    {
        $uQuiz = DB::table('answers')
                    ->join('quizzes', 'answers.quiz_id', '=', 'quizzes.id')
                    ->where('answers.user_id','=',Auth::user()->id)
                    ->orderBy('quizzes.start_on','desc')
                    ->paginate(10);

        $personal = $this->getPersonalInfo(Auth::user()->id);

        return view('user.dashboard.quizzes',['personalInfo'=>$personal,'quizzes'=>$uQuiz]);
    }
    /**
     * Display a listing of user friends.
     *
     * @return \Illuminate\Http\Response
     */
    public function showFriends()
    {
        $friends = User::find(Auth::user()->id)->friends;
        $personal = $this->getPersonalInfo(Auth::user()->id);

        return view('user.dashboard.friends',['personalInfo'=>$personal,'friends'=>$friends] );
    }

    /*
     * Add friend to list
     */
    public function addFriend($id)
    {
        return User::find(Auth::user()->id)->addFriend($id);
    }

    /*
     * Remove friend from list
     */
    public function removeFriend($id)
    {
        return User::find(Auth::user()->id)->removeFriend($id);
    }
    /**
     * Display a listing of user settings.
     *
     * @return \Illuminate\Http\Response
     */
    public function showSettings()
    {
        $personal = $this->getPersonalInfo(Auth::user()->id);
        return view('user.dashboard.settings',['personalInfo'=>$personal,'settings'=>'']);
    }

    public function updateInfoView()
    {
        $acc = User::find(Auth::user()->id);
        $personal = $this->getPersonalInfo(Auth::user()->id);
        return view('user.dashboard.updateinfo',['account'=>$acc,'personalInfo'=>$personal]);
    }

    public function updateAccount(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required','regex:/(01)[0-9]{9}/','size:11','unique:users,phone,'.Auth::user()->id],
            'email' => ['email','unique:users,email,'.Auth::user()->id,'max:255'],
        ]);

        $user = User::find(Auth::user()->id);

        $user->name = $request->input('name');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');

        $user->save();

        return back()->with('msg',['type'=>'success','info' => 'Information Updated Successfully!']);;
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current' => ['required'],
            'password' => ['confirmed','required', 'min:6'],
        ]);

        $current_password = Auth::User()->password;           
        if(Hash::check($request->input('current'), $current_password))
        {          
            $user_id = Auth::User()->id;                       
            $obj_user = User::find($user_id);
            $obj_user->password = Hash::make($request->input('password'));
            $obj_user->save(); 
            return back()->with('msg',['type'=>'success','info' => 'Password changed successfully!']);
        }
        else
        {           
            return back()->with('msg',['type'=>'danger','info' => 'current password did not match']);
        } 
    }

    public function updateInfo(Request $request)
    {
        //IMPORTANT: DONT EDIT THE KEY NAME
        $request->validate([
            'institute' => 'string|max:100|nullable',
            'level' => 'string|max:30|nullable',
            'dob' => 'date|nullable',
            'present' => 'string|max:255|nullable',
            'permanent' => 'string|max:255|nullable',
        ]);
        //dd($request);
        $uInfo = UserInfo::firstOrCreate(['user_id'=>Auth::user()->id]);
        $uInfo->info  = json_encode($request->except(['_token']));
        $uInfo->save();

        return back()->with('msg',['type'=>'success','info' => 'Information Updated Successfully!']);
    }

    public function getPersonalInfo($id) // copied to HomeController
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
}
