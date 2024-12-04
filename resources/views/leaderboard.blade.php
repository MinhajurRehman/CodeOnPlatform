@include('nav.header')
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="scroll-stylish">
                <div class="heading-leader">
                       <h1> leaderboard </h1>
                </div>
                <br>
                <br>
                @foreach ($users as $user)
                <div class="leaderboard-container">
                    <div class="leaderboard-item">
                                <img src="{{ asset($user->profile_image) }}" alt="Player 1" class="leaderboard-image">
                                <div class="leaderboard-details">
                                    <div class="leaderboard-name">{{ $user->username }}  | <span style="font-size:14px; color:#28a745;"> {{ $user->user_about }} </span> </div>
                                </div>
                                <div class="leaderboard-points">{{ $user->leaderboard }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>


    </div>
</div>




<!-- Bootstrap CND JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<!-- Custom JS -->
<script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script src="js/jquery.min.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/smoothscroll.js"></script>
<script src="js/animsition.js"></script>
<script src="js/jquery.validate.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.pagepiling.min.js"></script>

<script src="js/scripts.js"></script>
</body>

</html>
