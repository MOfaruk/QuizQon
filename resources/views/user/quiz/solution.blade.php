@extends('layouts.quiz_master')
@section('title','Solution: '.$quiz->title)
@section('dashboard-content')

<section>
    {{-- <div class="row">    
        <div class="col-md-8 offset-md-2 rounded-div my-5">
        <h2 class="h1 text-center my-3">Solution - {{$quiz->title}}</h2>
        </div>
    </div> --}}
    <div class="row">
        <div class="col-md-8 offset-md-2 mb-3">
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="myAnswerSwitch" {{ $bUserAns==true? 'checked':''}}>
                <label class="custom-control-label" for="myAnswerSwitch">Show my answers</label>
            </div> 
        </div>
    </div>
    <div class="row mb-5">
        @foreach ($qsWithAns as $key=>$item)
        <div class="card shadow-sm border-success form-group col-md-8 offset-md-2 option-container p-4">
            <div class="row">
                <label class="form-control-label col-md-8"><b>[{{ $key+1}}] {!!$item->desc!!}</b>
                </label>
            </div>
            <div class="col-md-12 options">
                <div class="mb-2">
                    <div class="custom-control custom-radio d-inline w-10">
                        <input type="radio" name="qs_{{$key+1}}" value="1" class="custom-control-input" {{ $item->correct==1? 'checked':'disabled'}}>
                        <label class="custom-control-label" for="11"></label>
                    </div>{{$item->option1}}                    
                    <!-- No delete btn for first input -->
                </div>
                <div class="mb-2">
                    <div class="custom-control custom-radio d-inline w-10">
                        <input type="radio" name="qs_{{$key+1}}" value="2" class="custom-control-input" {{ $item->correct==2? 'checked':'disabled'}}>
                        <label class="custom-control-label" for="12"></label>
                    </div>{{$item->option2}}
                    <!-- No delete btn for first input -->
                </div>
                <div class="mb-2">
                    <div class="custom-control custom-radio d-inline w-10">
                        <input type="radio" name="qs_{{$key+1}}" value="3" class="custom-control-input" {{ $item->correct==3? 'checked':'disabled'}}>
                        <label class="custom-control-label" for="13"></label>
                    </div>{{$item->option3}}
                    <!-- No delete btn for first input -->
                </div>
                <div class="mb-2">
                    <div class="custom-control custom-radio d-inline w-10">
                        <input type="radio" name="qs_{{$key+1}}" value="4" class="custom-control-input" {{ $item->correct==4? 'checked':'disabled'}}>
                        <label class="custom-control-label" for="14"></label>
                    </div>{{$item->option4}}
                    <!-- No delete btn for first input -->
                </div>
                <div class="mb-2">
                    @if($bUserAns)
                    <b>Your Answer:</b> 
                    @php
                     foreach ($userAns as  $ans) {
                         if($ans->qsId == $item->id)
                         {
                             switch ($ans->ans) {
                                 case '1':
                                    echo $item->option1;
                                    break;
                                case '2':
                                    echo $item->option2;
                                    break;
                                case '3':
                                    echo $item->option3;
                                    break;
                                case '4':
                                    echo $item->option4;
                                    break;
                                default:
                                    echo 'you didnot answer this';
                                    break;
                             }
                         }
                     }   
                    @endphp
                    @endif
                </div>
            </div>
        </div>           
        @endforeach
    </div>
</section>

@endsection

@section('link-act-solution')
active
@endsection


@push('head')
<meta name="solutionUrl" content="{{ route('quiz.solution',['id'=>$quiz->id,'title'=>Str::slug($quiz->title)]) }}">
@endpush

@push('scripts')
<script>
    var solutionUrl = $('meta[name="solutionUrl"]').attr("content")
    $(document).ready(function() {        

        $('#myAnswerSwitch').change(function() {
            if($(this).is(":checked")) {
                $(location).attr('href',solutionUrl+"?bUserAns=1");
            } else{
                $(location).attr('href',solutionUrl);
            }     
        });
    });
</script>
@endpush
