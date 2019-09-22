//Global Data
var qidmeta = $('meta[name="quiz-id"]');
var quiz_id = quiz_id = qidmeta.attr("content");
var waitTime;
var loadedData;
var bQuizLoaded = false;
var bAnswerSubmitted = false;
var duration=0;
var nTry=3;
var solveTime=-1;
//
$(window).on('load',function(){
    //console.log(quiz_id);
    loadAndInsertData();
});

//Getting Questions
$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

async function loadAndInsertData()
{
    console.log("loaddata()");
    jQuery.ajax({
        url:'/quiz-api/'+quiz_id,
        type: 'GET',
        data: {
        },
        success: function( data ){
            //manupulateBody(data);
            loadedData = data;
            waitTime = data['waitTime'];
            duration = data['duration'];
            
            console.log(data);
            //console.log(loadedData);

            if(loadedData['quiz'].length > 1)                
            {
                bQuizLoaded = true;
                insertIntoBody();
            }
            
            if(data['prev']==1)
                $('#btnShowScore').removeClass('d-none');
        },
        error: function (xhr, b, c) {
            console.log("xhr=" + xhr + " b=" + b + " c=" + c);
            showCommError();
        }
    });
}

// Timer
// Set the date we're counting down to

// Update the count down every 1 second
var x = setInterval(function() {
    // Get today's date and time
    //var now = new Date().getTime();

    // Find the distance between now and the count down date
    //var distance = countDownTime - now;
    //console.log(now +"  "+countDownTime);

    //console.log(countDownTime);

    //1.1 Time calculations for days, hours, minutes and seconds
    if(waitTime >=2)
    {
        var days = Math.floor(waitTime / ( 60 * 60 * 24));
        var hours = Math.floor((waitTime % ( 60 * 60 * 24)) / ( 60 * 60));
        var minutes = Math.floor((waitTime % ( 60 * 60)) / 60);
        var seconds = Math.floor((waitTime % ( 60)) );

        //1.2 Display the result in the element with id="demo"
        var txt="";
        if(days)
            txt =  days + "D ";
        txt = txt + hours + "H "+ minutes + "M " + seconds + "S ";
        $("#timer").html(txt);
    }

    //2.0 Quiz Start
    else if ( (waitTime < 2 ) && !bQuizLoaded) 
    {
        loadAndInsertData();
        //clearInterval(x);
        //startQuizTimer();
        $("#timer").html("Quiz Started");
    }
    else if( waitTime*(-1) < duration*60) // Quiz Running
    {        
        $('.progress-bar').css('width',(waitTime*(-1)*100/(duration*60))+'%');
        $('#progress-stat').text( parseInt((waitTime*(-1))/60)+':'+ parseInt((waitTime*(-1)))%60);
    }
    //3.0 submit quiz when finishes
    else if( waitTime*(-1) >= duration*60 && !bAnswerSubmitted && (nTry > 0) ) 
    {
        if( (waitTime*(-1))%5 == 0) //each 5 sec delay
        {
            submitAnswer();       
            nTry--;
        }
    }    
    //4.0 stoping the timer
    if(bAnswerSubmitted || nTry<=0)
    {
        showSubmitSuccessNotification();
        clearInterval(x);
    }
    
    //Decrement countDownTime
    waitTime = waitTime - 1;


}, 1000);


function insertIntoBody()
{
    console.log("inserting into body with");
    console.log(loadedData);

    if(waitTime*(-1) > duration*60) //contest ended: Virtual COntest
    {
        waitTime = 0;
        $('#btnSubmit').removeClass('btn-success');
        $('#btnSubmit').removeClass('d-none');
        $('#btnSubmit').addClass('btn-warning');
        $('#btnSubmit').html('VC');
    }
    else //contest started
    {
        $('#btnSubmit').removeClass('d-none');
    }
    console.log('start time :'+ waitTime);
    var i=1;
    loadedData['quiz'].forEach(qs => {
        opId = qs['id'];
        var text = 
        '<div class="card form-group col-sm-8 offset-md-2 option-container p-4">'+
            '<label class="form-control-label col-lg-3"><b>['+i++ + '] ' + qs['desc'] +'</b></label>'+
            '<div class="col-sm-12 options">'+
                '<div class="mb-2">'+
                    '<div class="custom-control custom-radio d-inline w-10">'+
                        '<input type="radio" name="qs_'+ opId +'" value="1" class="custom-control-input" id="'+ opId+1 +'">'+
                        '<label class="custom-control-label" for="'+ opId+1 +'"></label>'+
                    '</div>'+
                    qs['option1']+
                    '<!-- No delete btn for first input -->'+
                '</div>'+
                '<div class="mb-2">'+
                    '<div class="custom-control custom-radio d-inline w-10">'+
                        '<input type="radio" name="qs_'+ opId +'" value="2" class="custom-control-input" id="'+ opId+2 +'">'+
                        '<label class="custom-control-label" for="'+ opId+2 +'"></label>'+
                    '</div>'+
                    qs['option2']+
                    '<!-- No delete btn for first input -->'+
                '</div>'+
                '<div class="mb-2">'+
                    '<div class="custom-control custom-radio d-inline w-10">'+
                        '<input type="radio" name="qs_'+ opId +'" value="3" class="custom-control-input" id="'+ opId+3 +'">'+
                        '<label class="custom-control-label" for="'+ opId+3 +'"></label>'+
                    '</div>'+
                    qs['option3']+
                    '<!-- No delete btn for first input -->'+
                '</div>'+
                '<div class="mb-2">'+
                    '<div class="custom-control custom-radio d-inline w-10">'+
                        '<input type="radio" name="qs_'+ opId +'" value="4" class="custom-control-input" id="'+ opId+4 +'">'+
                        '<label class="custom-control-label" for="'+ opId+4 +'"></label>'+
                    '</div>'+
                    qs['option4']+
                    '<!-- No delete btn for first input -->'+
                '</div>'+
                
            '</div>'+
        '</div>';
        ;
        $('#qs_container').append(text);
    });

    // Must set countDownTime to Zero
    //console.log(countDownTime);
    //countDownTime = 0;
}
//

//Submitting form data
$('#btnSubmit').click(function(e){
    e.preventDefault(); 
    //alert("btn submit");
    // ajax csrf token initialization done above
    submitAnswer();
});
function submitAnswer()
{
    console.log('Submit time :'+ waitTime);
    var data = $("#ansForm").serialize();
    console.log("submitAnswer()");

    if(solveTime == -1)// first submission
        solveTime = waitTime * (-1);

    //if(!bLoggedIn)
    showSubmittingNotification();

    $.ajax({
        type:'POST',
        url:'/quiz-api/'+quiz_id,
        data:{
            data:data,
            solveTime: solveTime
        },
        success:function(data){
            //alert(data.success);
            console.log(data);
            if( (data['msgCode']==1062)) //SQL Duplicate entry for unique key
            {
                console.log(data['msgCode']);
                bAnswerSubmitted = true;
            }
            else if(data['msgCode']==1000) //success
            {
                bAnswerSubmitted = true;
                showSubmitSuccessNotification();
            }
            else if(nTry<=0)
            {
                Swal.close();
                
                Swal.fire({
                    type: 'error',
                    title: '',
                    text: data['msgCode']+': Communication Error!',
                    confirmButtonColor: '#00c851',
                    confirmButtonText: 'Ok',
                });                
            }          
        },
        error: function(){
            showCommError();
        }
    });
}
// end submitting form data

$('#btnShowScore').click(function(e){
    e.preventDefault(); 
    showScore();
});

function showScore() {
    var scText="";
    jQuery.ajax({
        url:'/score-api/'+quiz_id,
        type: 'GET',
        success: function( data ){
            console.log(data);
            userAns = JSON.parse(data['answer'][0]['ans_json']);
            //console.log(userAns[0]['ans']);
            var i=1;
            data['questions'].forEach(qs => {

                if (typeof qs['option'+userAns[i-1]['ans']] == 'undefined')
                    ya = "";
                else
                    ya= qs['option'+userAns[i-1]['ans']];

                qa = qs['option'+qs['correct']];
                
                scText +=
                '<div class="card my-2">'+
                    '<div class="card-body">'+
                        '<b>['+ i +'] '+ qs['desc'] +'</b><br>'+
                        '<b>Your Ans &nbsp;&nbsp;&nbsp;&nbsp;</b> '+ ya +'<br>'+
                        '<b>Correct Ans &nbsp;</b> '+ qa +
                    '</div>'+
                '</div>';
                i++;
            });

            scText +=
                '<div class="card my-2 bg-warning">'+
                    '<div class="card-body align-left">'+
                        '<b>Summary</b> '+'<br>'+
                        'Correct: '+ data["answer"][0]["correct"]+'<br>'+
                        'Wrong: '+ data["answer"][0]["wrong"] +'<br>'+
                        'Unattempted</b> '+ data["answer"][0]["unattempted"] +'<br>'+
                        'Solve Time</b> '+ parseInt((data["answer"][0]["solve_time"])/60) +':'+ (data["answer"][0]["solve_time"])%60 +'<br>'+
                        '<b>Total </b> '+ data["answer"][0]["score"] +
                    '</div>'+
                '</div>';

            Swal.fire({
                title: '<strong class="text-warning">Your Score</strong>',
                //type: 'info',
                html: scText,
                showCloseButton: true,
                showConfirmButton: false,
                allowOutsideClick: false
            })
        },
        error: function (xhr, b, c) {
            console.log("xhr=" + xhr + " b=" + b + " c=" + c);
            showCommError();
        }
    });    
}

//Taking info from user using sweet alert2
function showSubmittingNotification()
{
    Swal.fire({
        title: 'Please Wait!',
        text: 'submitting answers',
        imageUrl: '/images/behance.net-gallery-31234507-Open-source-Loading-GIF-Icons-Vol-1.gif',
        imageWidth: 100,
        imageHeight: 100,
        imageAlt: 'Custom image',
        animation: false,
        showConfirmButton: false,
        allowOutsideClick:false
      })
}

function showSubmitSuccessNotification() 
{    
    Swal.close();
    Swal.fire({
        type: 'success',
        title: '',
        text: 'answers submitted successfully!',
        confirmButtonColor: '#00c851',
        confirmButtonText: 'View Scoreboard',
        onClose: () => {
            var url = "../scoreboard/"+quiz_id+"?page=-1";    
            $(location).attr('href',url);
        }
    });
}

function showCommError()
{
    Swal.fire({
        type: 'error',
        title: '',
        text: 'Cannot Acess Website!, may be your internet not connected',
        confirmButtonColor: '#00c851',
        confirmButtonText: 'Ok',
        })   
}

/*
function startQuizTimer()
{
    var start = new Date().getTime();
    var qt = setInterval(function(){
        var now = new Date().getTime();
        diff = now - start;
        console.log(diff); // 1000 2000 3000

        $('.progress-bar').css('width',(diff/(duration*60*10))+'%');
        $('#progress-stat').text( parseInt((diff/1000)/60)+':'+ parseInt((diff/1000))%60);

        if(diff > 5*10000)
        {
            clearInterval(qt);
            submitAnswer();
        }

    },1000);
}
*/