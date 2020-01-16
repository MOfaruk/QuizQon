
<footer class="page-footer font-small stylish-color-dark pt-4">
    <div class="container text-center text-md-left">    
        <div class="row">
        
            <div class="col-md-3 mx-auto text-center">                
                <img src="/images/logo-gray-60x60.png" alt="quizqon-logo-gray" width="40" height="40">
                <h2 class="text-muted font-weight-bold">QuizQon</h2>
                <h6 class="text-muted">Online Quiz Contest Organizer</h6>
            </div>        

            <hr class="clearfix w-100 d-md-none">
        
            <div class="col-md-3 mx-auto">
                <h6 class="text-uppercase mb-4 font-weight-bold">Important Links</h6>

                <ul class="list-unstyled">
                    <li>
                    <a href="{{ route('about') }}">About us</a>
                    </li>
                </ul>
            </div>        

            <hr class="clearfix w-100 d-md-none">
        
            <div class="col-md-3 mx-auto">
                <h6 class="text-uppercase mb-4 font-weight-bold">Legal</h6>

                <ul class="list-unstyled">
                    <li>
                        <a href="{{ route('privacy') }}">Privacy Policy</a>
                    </li>
                    <li>
                        <a href="{{ route('tou') }}">Terms of use</a>
                    </li>
                    <li>
                        <a href="{{ route('disclaimer') }}">Disclaimer</a>
                    </li>
                </ul>
            </div>        

            <hr class="clearfix w-100 d-md-none">
        
            <div class="col-md-3 mx-auto">
                    <h6 class="text-uppercase mb-4 font-weight-bold">Contact</h6>
                    <p>
                      <i class="fa fa-home mr-3"></i> Dhaka, Bangladesh</p>
                    <p>
                      <i class="fa fa-envelope mr-3"></i> quizqon@gmail.com</p>
                    {{-- <p>
                      <i class="fa fa-phone mr-3"></i> + 01 234 567 89</p> --}}
                    <p>
                        <i class="fa fa-facebook mr-3"></i><a href="https://facebook.com/quizqon">QuizQon FB page</a> </p>
                    <p>
                    <i class="fa fa-globe mr-3"></i> <a href="{{route('contact')}}">Contact Us</a></p>
            </div>        
        </div>
    </div>

    <div class="footer-copyright text-center py-3">© 2020 Copyright:
        <a href="{{ route('home')}}"> QuizQon.com</a>
    </div>
    <!-- Fb Chat Plugin -->
    <!-- Load Facebook SDK for JavaScript -->
    <script>
        window.fbAsyncInit = function() {
          FB.init({
            xfbml            : true,
            version          : 'v5.0'
          });
        };
  
        (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>
  
      <!-- Your customer chat code -->
      {{-- <div class="fb-customerchat"
          attribution=setup_tool
          page_id="102515057799778"
          logged_in_greeting="Hi! How can we help you?"
          logged_out_greeting="Hi! How can we help you?">
      </div> --}}
</footer>