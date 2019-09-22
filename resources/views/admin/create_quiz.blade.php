@extends('layouts.app')

@section('content')
<div class="container">    
{{ Form::open(array('action' => 'QuizController@store')) }}
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-3">
                <div class="card-header">Quiz Information</div>

                <div class="card-body">
                <input type="text" class="form-control w-50" name="qz_title" placeholder="title">
                <textarea class="form-control w-50" name="qz_desc" placeholder="description.." ></textarea>
                <input type="datetime-local" class="form-control w-50" name="qz_start_on" >
                <input type="number" class="form-control w-50" name="qz_duration" placeholder="duration in minute">
                <input type="number" class="form-control w-50" min="1" max="25" name="qz_nQs" placeholder="number of qestion">
                </div>
            </div>

            @for($i=1;$i<=20;$i++)
            <div class="card mb-3">
                <div class="card-header">Question {{$i}}</div>

                <div class="card-body">
                    <div class="form-group">
                        <label for="usr">Question:</label>
                        <textarea class="form-control" id="usr" name="{{'qsDesc_'.$i}}"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="usr">Option 1:</label>
                        <input type="text" class="form-control w-50" id="usr" name="{{'qs_'.$i.'_op_1'}}">
                    </div>
                    <div class="form-group">
                        <label for="usr">Option 2:</label>
                        <input type="text" class="form-control w-50" id="usr" name="{{'qs_'.$i.'_op_2'}}">
                    </div>
                    <div class="form-group">
                        <label for="usr">Option 3:</label>
                        <input type="text" class="form-control w-50" id="usr" name="{{'qs_'.$i.'_op_3'}}">
                    </div>
                    <div class="form-group">
                        <label for="usr">Option 4:</label>
                        <input type="text" class="form-control w-50" id="usr" name="{{'qs_'.$i.'_op_4'}}">
                    </div>
                    <div class="form-group">
                        <label for="ans">Correct Answer</label>
                        <select class="form-control w-25" id="ans" name="{{ 'ans_'.$i }}">
                        <option value="1">Option 1</option>
                        <option value="2">Option 2</option>
                        <option value="3">Option 3</option>
                        <option value="4">Option 4</option>
                        </select>
                    </div>
                </div>
            </div>
            @endfor

            <div class="text-center">
                <button type="submit" class="btn btn-success">Create</button>
            </div>
        </div>
        
    </div>
{{ Form::close() }}
</div>
@endsection