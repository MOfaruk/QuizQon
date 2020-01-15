@extends('layouts.dashboard_master')

@section('title','Profile')

@section('dashboard-content')


<div class="card-body row text-center">
    <div class="col-sm-6">
        <h2 id="totQuiz">loading...</h2>
        Total Quizzes
    </div>
    <div class="col-sm-6">
        <h2 id="avgScore">loading...</h2>
        Average Score(last 10)
    </div>
</div>
<div class="row p-5">
    <canvas id="myChart"></canvas>
</div>

@endsection

@section('link-act-profile')
active
@endsection

@push('scripts')
<!--<script src="/js/Chart.min.js"></script> -->

<script>
var userIdMeta = $('meta[name="user-id"]');
//api calling throw ajax
$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    //async: false //depricated
});

$.ajax({
    url: '/dashboard/user-score/'+userIdMeta.attr("content"),
    type: 'GET',
    data: {
    },
    success: function( data ){
        var scores = data["scores"];
        
        var label=[], vals=[];
        scores.forEach(score => {
            label.push(score["date"]);
            vals.push(score["rScore"]);
        });

        label.push(""); //for extra empty label in right
        showChart(label,vals);

        showTotalAverage(data["total"],data["avg"]);
    },
    error: function (xhr, b, c) {
        console.log("xhr=" + xhr + " b=" + b + " c=" + c);
    }
});


//showing data to page
function showChart(chartX, chartY) {
    var ctx = document.getElementById('myChart');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartX,
            datasets: [{
                label: 'Score in %',
                data: chartY,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 2
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: false,
                        max:100
                    }
                }]
            }
        }
    });
}

//showing total and average
function showTotalAverage(total, avg) {
    $("#totQuiz").text(total);
    $("#avgScore").html(avg.toFixed(2)+"<span class='h6'>%</span>");
}
</script>
@endpush
