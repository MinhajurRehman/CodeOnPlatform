@include('nav.header')

<style>

    /* Center website */
    .main {
      max-width: 1000px;
      margin: auto;
    }

    h1 {
      font-size: 50px;
      word-break: break-all;
    }

    .row {
      margin: 10px -16px;
    }

    /* Add padding BETWEEN each column */
    .row,
    .row > .column {
      padding: 8px;
    }

    /* Create three equal columns that floats next to each other */
    .column {
      float: left;
      width: 33.33%;
      display: none; /* Hide all elements by default */
    }

    /* Clear floats after rows */
    .row:after {
      content: "";
      display: table;
      clear: both;
    }

    /* Content */
    .content {
      background-color: white;
      padding: 10px;
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

    .myBtnCenter{
        text-align: center;
    }
    .bg ol li{
        background: transparent !important;

    }
    .bg ol li a{
        color: white !important;
        line-height: 2;
    }

    .table tbody,tr,td{
        background-color: transparent !important;
        color: white !important;
    }


    </style>

    <div class="row">


        <div class="scroll-stylish">
            <div class="heading-leader">
                <h1> Open Challenges </h1>
            </div>
<br>
   {{--  open challenge  --}}

<button type="button" class="btn btn-success" data-toggle="modal" data-target="#OpenChallenge" id="openModalButton">
    Create Open Challenge
</button>

{{--  popup open challenge  --}}
<div class="modal fade" id="OpenChallenge" tabindex="-1" aria-labelledby="createPostModalLabel"
aria-hidden="true">
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="createPostModalLabel">Open Challenges</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <h4>Select Programming Language</h4>
            <br>
        <form action="{{ route('challenges.create') }}" method="POST">
         @csrf
         <select class="form-control" name="language" required>
            <option value="php">PHP</option>
            <option value="node">JavaScript</option>
            <option value="python">Python</option>
        </select>
        <br>
        <button type="submit">Create Challenge</button>
        </form>
        </div>
        </div>
</div>
</div>

<br>
<br>



{{--  open challenge show  --}}
<table class="table table-hover">
    <thead>
        <tr>
            <th>Profile Image</th>
            <th>Username</th>
            <th>Language</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($challenges as $challenge)
        <tr>
            <td>
                <img src="{{ $challenge->creator_image }}" alt="Profile" width="50">
            </td>
            <td>{{ $challenge->creator_username }}</td>
            <td>{{ $challenge->language }}</td>
            <td>
                @if (session('loginId') == $challenge->creator_id)
                    <span>You are creator</span>
                    @elseif ($challenge->joiner_id === null)
                        <a href="{{ route('challenges.join', $challenge->id) }}" class="btn btn-primary">Join</a>
                    @else
                    <span>Working</span>
                    @endif
                </td>
        </tr>

        <script>
            let hasRedirected = false; // Flag to track if redirect has already happened

            const checkRedirect = async () => {
                if (!hasRedirected) { // Only proceed if not already redirected
                    try {
                        const response = await fetch("{{ route('challenges.checkRedirect', ['id' => $challenge->id]) }}");
                        const data = await response.json();
                        if (data.redirect) {
                            hasRedirected = true; // Set flag to true after redirect
                            {{--  window.location.href = "{{ url('/openChallenge-compiler') }}";  --}}
                            window.location.href = "{{ route('challenges.verses', ['id' => $challenge->id]) }}";
                        } else {
                            // If not redirected, recheck after a small delay
                            setTimeout(checkRedirect, 1000); // Re-check every 1 second
                        }
                    } catch (error) {
                        console.error('Error:', error); // Handle fetch errors
                    }
                }
            };

            // Start the check immediately
            checkRedirect();
        </script>


        @endforeach
    </tbody>
</table>


</div>

    {{--  open challenge show closed  --}}


</div>
    {{--  open challenge closed  --}}

      {{--  <!-- jQuery and Bootstrap JS -->  --}}
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

      <!-- JavaScript for Toggle Functionality -->
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
          btns[i].addEventListener("click", function(){
            var current = document.getElementsByClassName("active");
            current[0].className = current[0].className.replace(" active", "");
            this.className += " active";
          });
        }
      </script>



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
