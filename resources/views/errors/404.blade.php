@extends('layouts.user_master')

@section('content')
<div class="container-fluid">
    <section>
        <div class="row pb-5">
            <div class="col-md-6 offset-md-3" id="search-bar">
                <h1 class="text-center mt-5 mb-3" style="color:#4dcb44; font-size:10em; font-family:Comic Sans MS, cursive, sans-serif;">404</h1>
                <!-- <div class="rounded-div bg-white">
                    <input type="text" class="form-control" style="border-radius:2rem;width:100%; height:45px">
                </div> -->
                <div class="text-center mb-5">
                    <h2 class="h2">OOPS! the requested page can't find.</h2>
                </div>
                <div class="input-group mb-3 ">
                  <input type="text" class="form-control z-depth-2" placeholder="author, quiz, course, anything ..." aria-describedby="basic-addon2" style="border-top-left-radius:1.5rem; border-bottom-left-radius:1.5rem; height:45px">
                  <div class="input-group-append" >
                    <span class="input-group-text bg-green-light z-depth-2" id="basic-addon2" style="border-top-right-radius:1.5rem; border-bottom-right-radius:1.5rem; height:45px; background-color: #4dcb44;border: 3px solid #ffffff; color: #ffffff;cursor: pointer;">search</span>
                  </div>
                </div>
            </div>
        </div>
        
    </section>
</div>
@endsection