<div class="col-md-3">
    
    <div class="card mb-2 p-2">
        <img src="{{ asset('images/images.jpg')}}" class="rounded-circle float-left" width="80px">
        <div class="col-md-6">
            {{Auth::user()->name}} <i class="fa fa-trophy text-warning fa-3x"></i>
            <i class="fa fa-trophy fa-3x" style="color:#D2691E"></i>
            <i class="fa fa-trophy fa-3x" style="color:#aaa9ad"></i>
        </div>
    </div>

    <div id="accordion" class="accordion">
        <div class="card mb-0">
            <div class="card-header collapsed" data-toggle="collapse" href="#collapseOne">
                <a class="card-title text-success font-weight-bold">
                    Quiz
                </a>
            </div>
            <div id="collapseOne" class="card-body collapse show" data-parent="#accordion" >
                <ul>
                    <li><a href="{{ route('dashboard.index')}}">Profile</a></li>
                    <li><a href="{{ route('dashboard.contests')}}">Contests</a></li>
                    <li><a href="{{ route('dashboard.friends')}}">Friends</a></li>
                    <li><a href="{{ route('dashboard.settings')}}">Settings</a></li>
                </ul>
            </div>
            <!------
            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                <a class="card-title">
                  Item 2
                </a>
            </div>
            <div id="collapseTwo" class="card-body collapse" data-parent="#accordion" >
                <ul>
                    <li><a href="#">link</a></li>
                    <li><a href="#">link</a></li>
                    <li><a href="#">link</a></li>
                    <li><a href="#">link</a></li>
                </ul>
            </div>
            <div class="card-header collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                <a class="card-title">
                  Item 3
                </a>
            </div>
            <div id="collapseThree" class="collapse" data-parent="#accordion" >
                <div class="card-body">
                    <ul>
                        <li><a href="#">link</a></li>
                        <li><a href="#">link</a></li>
                        <li><a href="#">link</a></li>
                        <li><a href="#">link</a></li>
                    </ul>
                </div>
            </div>
            -->
        </div>
    </div>
</div> 