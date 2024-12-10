@include('nav.header')

<Style>
    .carousel {
        margin: 50px auto;
        padding: 0 70px;
    }

    .carousel .item {
        color: #ffffff;
        min-height: 325px;
        text-align: center;
        overflow: hidden;
    }

    .carousel .thumb-wrapper {
        padding: 25px 15px;
        border-radius: 6px;
        text-align: center;
        position: relative;
        box-shadow: 0 2px 3px rgba(0, 0, 0, 0.2);
    }

    .carousel .item .img-box {
        height: 120px;
        margin-bottom: 20px;
        width: 100%;
        position: relative;
    }

    .carousel .item img {
        max-width: 100%;
        max-height: 100%;
        display: inline-block;
        position: absolute;
        bottom: 0;
        margin: 0 auto;
        left: 0;
        right: 0;
    }

    .carousel .item h4 {
        font-size: 18px;
    }

    .carousel .item h4,
    .carousel .item p,
    .carousel .item ul {
        margin-bottom: 5px;
    }

    .thumb-content .button-group {
        display: flex;
        gap: 10px;
        /* Adjust spacing between buttons as needed */
        padding-left: 30px;
    }

    .thumb-content .btn {
        color: #7ac400;
        font-size: 11px;
        text-transform: uppercase;
        font-weight: bold;
        background: none;
        border: 1px solid #7ac400;
        padding: 6px 14px;
        line-height: 16px;
        border-radius: 20px;
    }

    .carousel .thumb-content .btn:hover,
    .carousel .thumb-content .btn:focus {
        color: #fff;
        background: #7ac400;
        box-shadow: none;
    }

    .carousel .thumb-content .btn i {
        font-size: 14px;
        font-weight: bold;
        margin-left: 5px;
    }

    .carousel .item-price {
        font-size: 13px;
        padding: 2px 0;
    }

    .carousel .item-price strike {
        opacity: 0.7;
        margin-right: 5px;
    }

    .carousel-control-prev,
    .carousel-control-next {
        height: 44px;
        width: 40px;
        background: #7ac400;
        margin: auto 0;
        border-radius: 4px;
        opacity: 0.8;
    }

    .carousel-control-prev:hover,
    .carousel-control-next:hover {
        background: #78bf00;
        opacity: 1;
    }

    .carousel-control-prev i,
    .carousel-control-next i {
        font-size: 36px;
        position: absolute;
        top: 50%;
        display: inline-block;
        margin: -19px 0 0 0;
        z-index: 5;
        left: 0;
        right: 0;
        color: #fff;
        text-shadow: none;
        font-weight: bold;
    }

    .carousel-control-prev i {
        margin-left: -2px;
    }

    .carousel-control-next i {
        margin-right: -4px;
    }

    .carousel-indicators {
        bottom: -50px;
    }

    .carousel-indicators li,
    .carousel-indicators li.active {
        width: 10px;
        height: 10px;
        margin: 4px;
        border-radius: 50%;
        border: none;
    }

    .carousel-indicators li {
        background: rgba(0, 0, 0, 0.2);
    }

    .carousel-indicators li.active {
        background: rgba(0, 0, 0, 0.6);
    }

    .carousel .wish-icon {
        position: absolute;
        right: 10px;
        top: 10px;
        z-index: 99;
        cursor: pointer;
        font-size: 16px;
        color: #abb0b8;
    }

    .carousel .wish-icon .fa-heart {
        color: #ff6161;
    }

    div#social-links {
        margin: 0 auto;
        max-width: 300px;
    }

    div#social-links ul li {
        display: inline-block;
    }

    div#social-links ul li a {
        padding: 20px 20px;
        margin: 5px;
        font-size: 30px;
    }

    /* The "show" class is added to the filtered elements */
    .show {
        display: block;
    }

    /* Style the buttons */
    .btn {
        border: none;
        outline: none;
        padding: 12px 16px;
        background-color: green;
        cursor: pointer;
    }

    .btn:hover {
        background-color: #ddd;
        color: black;
    }

    .btn.active {
        background-color: #666;
        color: white;
    }

    .myBtnCenter {
        text-align: center;
    }

    .ratings i {
        font-size: 16px;
        color: red
    }

    .strike-text {
        color: red;
        text-decoration: line-through
    }

    .product-image {
        width: 100%
    }

    .dot {
        height: 7px;
        width: 7px;
        margin-left: 6px;
        margin-right: 6px;
        margin-top: 3px;
        background-color: blue;
        border-radius: 50%;
        display: inline-block
    }

    .spec-1 {
        color: #fff;
        font-size: 15px;
    }

    h4 {
        color: green;
        font-weight: bolder;
        font-size: 25px;
    }

    .para {
        font-size: 16px
    }

    .btn-danger{
        background-color: red;
    }
</Style>


<div id="myBtnContainer" class="myBtnCenter">
    <button class="btn active" onclick="filterSelection('list')"> Tournament Announcements </button>
    <button class="btn" onclick="filterSelection('form')">Results Announcements</button>
</div>

<br>
<br>

<div id="listSection" class="mt-4 bg" style="display:none;">
        <div class="scroll-stylish">
                <div class="heading-leader">
                    <h1> Active Tournaments </h1>
                </div>

                @if ($tournaments->isEmpty())
                    <div class="alert alert-danger">
                        No data availaible
                    </div>
                @endif
                    <br>
                    <br>

            @foreach ($tournaments as $tour)
            @php
            $tournamentEndTime = Carbon\Carbon::parse($tour->t_end_date_time);
            $tournamentEnded = $currentDateTime->greaterThanOrEqualTo($tournamentEndTime);
            @endphp
                {{--  update design  --}}
                <div class="d-flex justify-content-center row">
                    <div class="col-md-10">
                        <div class="row p-2 bg-transparent border-bottom rounded">
                            <div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded product-image"
                                    src="{{ asset($tour->t_poster_image) }}"></div>
                            <div class="col-md-6 mt-1">
                                <h4>{{ $tour->t_name }}</h4>
                                <div class="mt-1 mb-1 spec-1"><span><b>Tournament Start time:</b> <small> {{ \Carbon\Carbon::parse($tour->t_date_time)->format('g:i A, l, j F Y') }}</small></span><br><span
                                        ></span><span><b>Tournament End time:</b> <small> {{ \Carbon\Carbon::parse($tour->t_end_date_time)->format('g:i A, l, j F Y') }}</small></span><br><span
                                        ></span><span><b>Board perform minutes:</b> <small> {{ $tour->t_board_time }} minutes </small><br></span></div>
                                <div class="mt-1 mb-1 spec-1"><span><b>Tournament programming Language:</b> <small> {{ $tour->t_Plang }}</small></span></div>
                                <p class="text-justify para mb-0">{{ $tour->t_description }}.<br><br></p>
                            </div>
                            <div class="align-items-center align-content-center col-md-3  mt-1">
                                <div class="d-flex flex-column mt-4">
                                        <form action="{{ route('tournament_participant') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="tournament_id"
                                                value="{{ $tour->id }}">
                                            <input type="hidden" name="user_id"
                                                value="{{ $user->id }}">

                                        @if (!$tournamentEnded)
                                            <button class="btn btn-success btn-sm" type="submit"
                                                @if ($tour->organizer_id == $user->id || in_array($tour->id, $joinedTournamentIds)) disabled @endif>
                                                <i class="fa fa-handshake"></i>
                                                Join
                                            </button>
                                        @endif
                                            </form>
                                        @if (!$tournamentEnded)
                                            <button class="btn btn-sm mt-2" type="button" data-toggle="modal" data-target="#my-popup">
                                                <i class="fa fa-share-square"></i>
                                                Share
                                            </button>
                                        @endif
                                        <br>

                                        @if(session('loginId') === $tour->organizer_id)
                                            <form action="{{ route('tournament.delete', $tour->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this tournament?');">
                                                @csrf
                                                <button class="btn btn-danger btn-sm mt-2" type="submit">
                                                    <i class="fa fa-trash"></i>
                                                    Delete
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                <br>
                {{--  end scroll Div  --}}
        </div>
    {{--  end section div  --}}
</div>


<div id="formSection" class="mt-4 bg" style="display:none;">
    <div class="row">
        <div class="col-md-12">
            <div class="scroll-stylish">
                <div class="heading-leader">
                    <h1> Previous Tournament Results </h1>
                </div>
                <br>
                <br>


                <div id="winnerDetails">
                    {{--  <!-- Winner details will be dynamically populated here -->  --}}
                </div>

            </div>
        </div>
    </div>
</div>









{{--  model popup share button  --}}

<div class="modal fade" id="my-popup" tabindex="-1" aria-labelledby="createPostModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPostModalLabel">Share On Social Media</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div>
                    {!! $shareComponent !!}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
    // Default selection (showing list initially)
    filterSelection("list");

    function filterSelection(option) {
        var listSection = document.getElementById("listSection");
        var formSection = document.getElementById("formSection");

        // Hide both sections initially
        listSection.style.display = "none";
        formSection.style.display = "none";

        // Show the section based on the option
        if (option === "list") {
            listSection.style.display = "block"; // Show list
        } else if (option === "form") {
            formSection.style.display = "block"; // Show form
        }
    }

    // Add active class to the current button (highlight it)
    var btnContainer = document.getElementById("myBtnContainer");
    var btns = btnContainer.getElementsByClassName("btn");
    for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function() {
            var current = document.getElementsByClassName("active");
            current[0].className = current[0].className.replace(" active", "");
            this.className += " active";
        });
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Fetch winners from localStorage
        const winners = JSON.parse(localStorage.getItem('tournamentWinners')) || [];

        const winnerDetailsDiv = document.getElementById('winnerDetails');
        winnerDetailsDiv.innerHTML = ''; // Clear existing content

        winners.forEach(winner => {
            const winnerHTML = `
                <div class="d-flex justify-content-center row">
                    <div class="col-md-10">
                        <div class="row p-2 bg-transparent border-bottom rounded">
                            <div class="col-md-3 mt-1">
                                <img class="img-fluid img-responsive rounded product-image"
                                     src="https://i.pinimg.com/originals/81/6f/09/816f0912e313728bb3f945d8fdd4fac4.png">
                            </div>
                            <div class="col-md-6 mt-1">
                                <h4>${winner.tournamentName}</h4>
                                <div class="mt-1 mb-1 spec-1">
                                    <span><b>Tournament Winner Name:</b> <small>${winner.winnerName}</small></span>
                                </div>
                                <div class="mt-1 mb-1 spec-1">
                                    <span><b>Tournament Winner Points:</b> <small>${winner.winnerPoints}</small></span>
                                </div>
                                <div class="mt-1 mb-1 spec-1">
                                    <p class="text-success" style="font-size: 15px;"><b>Congratulations ${winner.winnerName}!</b> 🎉 Keep up the great work and continue to achieve more!</p>                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            winnerDetailsDiv.innerHTML += winnerHTML;
        });
    });

</script>



<!-- Bootstrap CND JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
</script>

<!-- Custom JS -->
<script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
<script src="js/jquery.min.js"></script>
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
