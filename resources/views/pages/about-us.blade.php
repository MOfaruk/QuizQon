@extends('layouts.user_master')
@section('title', 'About Us')
@section('content')
<section>
    <div class="container mb-5">
        <div class="row">
            <div class="col-md-8 mx-auto">            
                <h2 class="h1 text-center my-5">ABOUT US</h2>
            </div>
        </div>
        <div class="row text-left">
            <div class="col-md-8 mx-auto">
                {{-- Page Content starts here --}}
                <h4>WHO WE ARE</h4>
                <p>
                    QuizQon is a online quiz contest organizer. It established in 2019 with a mission to help the students.
                </p>
                <h4>WHAT WE DO</h4>
                <p>
                    We organizes quiz on various topics such as BCS, SSC, HSC, Bank Job etc. for students from different backgrounds.
                    
                </p>
            </div>
        </div>
    </div>
</section>

@endsection
