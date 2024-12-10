@include('nav.header')

<style>
    .avatar-container {
        position: relative;
        display: inline-block;
    }

    .avatar {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
    }

    .edit-overlay {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 55px;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
        opacity: 0;
        cursor: pointer;
        transition: opacity 0.3s ease;
    }

    .avatar-container:hover .edit-overlay {
        opacity: 1;
    }

    .edit-overlay span {
        font-size: 16px;
        font-weight: bold;
    }

    .file-input {
        display: none;
    }

</style>
<br>
<br>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="scroll-stylish">
            <div class="main-body">
                <div class="row gutters-sm">
                    <div class="col-md-4 mb-3">
                        <div class="card-3">
                            <div class="card-body-3">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="{{ asset($user->profile_image) }}" alt="Admin" style="border-radius: 50%; width: 120px; height: 120px;">
                                    <div class="mt-3">
                                        <h4>{{ $user->username }}</h4>
                                        <p class="text-muted font-size-sm">{{ $user->email }}</p>
                                        <p class="text-secondary mb-1">{{ $user->user_about ?? null }}</p>
                                        <p class="text-muted font-size-sm">{{ $user->user_city ?? null }}</p>
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#Tournament" id="openModalButton">
                                            Create Tournament
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-3 mt-3">

                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card-3 mb-3">
                            <div class="card-body-3">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ProfileEdit" id="openModalButton">
                                            Edit
                                        </button>

                                        @if ($tournaments->isNotEmpty())
                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#EnrollUsers" id="openModalButton">
                                            PARTICIPANTS
                                        </button>

                                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#Results" id="openModalButton">
                                            RESULTS
                                        </button>

                                        {{-- Result Popup --}}
                                        <div class="modal fade" id="Results" tabindex="-1" aria-labelledby="createPostModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="createPostModalLabel">RESULTS</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        @foreach ($tournaments as $tournament)
                                                        <div class="tournament-result" data-tid="{{ $tournament->id }}">
                                                        <div style="color:#28a745; text-align:center; font-size:25px; font-style:bold; text-transform:uppercase;">
                                                            {{ $tournament->t_name }}
                                                        </div>
                                                        <hr>
                                                        @php
                                                        $participantCount = count($tournament->patricipants);
                                                        $startDateTime = Carbon\Carbon::parse($tournament->t_date_time);
                                                        $endDateTime =
                                                        Carbon\Carbon::parse($tournament->t_end_date_time);
                                                        $currentDateTime = Carbon\Carbon::now();
                                                        @endphp

                                                        @if ($currentDateTime < $startDateTime) <p>The tournament has
                                                            not started yet.</p>
                                                            @elseif ($currentDateTime < $endDateTime) <p>The tournament
                                                                is still ongoing, results will be available after it
                                                                ends.</p>
                                                                @else

                                                                <ol class="participant-list">
                                                                    @for ($i = 0; $i < $participantCount; $i++) <li>{{
                                                                        $tournament->patricipants[$i]->participant->username
                                                                        }} | {{
                                                                        $tournament->patricipants[$i]->participant->email
                                                                        }} |
                                                                        @if($tournament->patricipants[$i]->tournament_participant_status === 'Done')
                                                                        {{
                                                                        $tournament->patricipants[$i]->participant->points
                                                                        }}
                                                                        @else
                                                                        <span style="color: red;">Sorry, they cant take
                                                                            your tournament seriously.</span>
                                                                        @endif
                                                                        </li>
                                                                        @endfor
                                                                </ol>
                                                                </div>
                                                                @endif
                                                                <hr>
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="storeWinner()">Announce Results</button>
                                                                <hr>
                                                                @endforeach
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- End result Popup --}}


                                        {{-- Tournament participants Popup --}}
                                        <div class="modal fade" id="EnrollUsers" tabindex="-1" aria-labelledby="createPostModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="createPostModalLabel">TOURNAMENT
                                                            PARTICIPANTS</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        @foreach ($tournaments as $tournament)
                                                        <div style="color:#28a745; text-align:center; font-size:25px; font-style:bold; text-transform:uppercase;">
                                                            {{ $tournament->t_name }}
                                                        </div>
                                                        <hr>

                                                        <ol>
                                                            @php
                                                            $participantCount = count($tournament->patricipants);

                                                            $tournamentDateTime =
                                                            Carbon\Carbon::parse($tournament->t_date_time);

                                                            $tournamentEndTime =
                                                            Carbon\Carbon::parse($tournament->t_end_date_time);

                                                            $canStartTournament =
                                                            $currentDateTime->greaterThanOrEqualTo($tournamentDateTime)
                                                            && $currentDateTime->lessThan($tournamentEndTime);
                                                            $tournamentEnded =
                                                            $currentDateTime->greaterThanOrEqualTo($tournamentEndTime);
                                                            @endphp

                                                            @if ($participantCount == 0)
                                                            <p>No participants yet</p>
                                                            @else

                                                            @for ($i = 0; $i < $participantCount; $i++) <li>{{
                                                                $tournament->patricipants[$i]->participant->username }}
                                                                | {{ $tournament->patricipants[$i]->participant->email
                                                                }}</li>
                                                                @endfor
                                                                @endif
                                                        </ol>
                                                        <hr>
                                                        @if(session('success'))
                                                        <div class="alert alert-success">
                                                            {{ session('success') }}
                                                        </div>
                                                        @endif
                                                        <form action="{{ route('tournament.start', $tournament->id) }}" method="POST">
                                                            @csrf
                                                            <button type="submit" class="btn btn-success btn-block" {{
                                                                $canStartTournament ? '' : 'disabled' }}>Start</button>
                                                        </form>
                                                        @if ($tournamentEnded)
                                                        <p class="text-muted">This tournament is ended.</p>
                                                        @elseif (!$canStartTournament)
                                                        <p class="text-muted">The tournament will be available to start
                                                            on {{ $tournamentDateTime->format('Y-m-d H:i A') }}</p>
                                                        @endif
                                                        <hr>
                                                        <hr>
                                                        @endforeach
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- End Tournament participants Popup --}}
                                        @endif

                                        {{-- Tournament Popup --}}
                                        <div class="modal fade" id="Tournament" tabindex="-1" aria-labelledby="createPostModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="createPostModalLabel">CREATE YOUR
                                                            TOURNAMENT</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <form action="{{ route('tournament') }}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            {{--
                                                            <!-- Tournament Owner Email --> --}}
                                                            <div class="mb-3">
                                                                <label for="t_email" class="form-label">Tournament Owner
                                                                    Email</label>
                                                                <input type="email" class="form-control" name="t_email" id="t_email" placeholder="Enter Your original email" required>
                                                            </div>

                                                            {{--
                                                            <!-- Tournament Name --> --}}
                                                            <div class="mb-3">
                                                                <label for="t_name" class="form-label">Tournament
                                                                    Name</label>
                                                                <input type="text" class="form-control" name="t_name" id="t_name" placeholder="Enter tournament name" required>
                                                            </div>

                                                            {{--
                                                            <!-- Tournament Poster Image --> --}}
                                                            <div class="mb-3">
                                                                <label for="t_poster_image" class="form-label">Tournament Poster Image</label>
                                                                <input type="file" class="form-control" name="t_poster_image" id="t_poster_image" accept="image/*" required>
                                                            </div>

                                                            {{--
                                                            <!-- Tournament Start Date & Time --> --}}
                                                            <div class="mb-3">
                                                                <label for="t_date_time" class="form-label">Start Date &
                                                                    Time</label>
                                                                <input type="datetime-local" class="form-control" name="t_date_time" id="t_date_time" required>
                                                            </div>

                                                            <script>
                                                                document.addEventListener("DOMContentLoaded", function() {
                                                                    const startDateTimeInput = document.getElementById("t_date_time");
                                                                    const boardTimeSelect = document.getElementById("t_board_time");
                                                                    const endDateTimeInput = document.getElementById("t_end_date_time");

                                                                    function calculateEndDateTime() {
                                                                        const startDateTime = startDateTimeInput.value;
                                                                        const boardTime = parseInt(boardTimeSelect.value);

                                                                        if (startDateTime && boardTime) {
                                                                            // Converting the start date-time to a local date object
                                                                            const startDate = new Date(startDateTime);

                                                                            // Adding only the board minutes
                                                                            startDate.setMinutes(startDate.getMinutes() + boardTime);

                                                                            // Formatting date-time for the input
                                                                            const year = startDate.getFullYear();
                                                                            const month = String(startDate.getMonth() + 1).padStart(2, '0'); // Months are 0-based
                                                                            const day = String(startDate.getDate()).padStart(2, '0');
                                                                            const hours = String(startDate.getHours()).padStart(2, '0');
                                                                            const minutes = String(startDate.getMinutes()).padStart(2, '0');

                                                                            const formattedDate = `${year}-${month}-${day}T${hours}:${minutes}`;
                                                                            endDateTimeInput.value = formattedDate;
                                                                        }
                                                                    }

                                                                    startDateTimeInput.addEventListener("change", calculateEndDateTime);
                                                                    boardTimeSelect.addEventListener("change", calculateEndDateTime);
                                                                });

                                                            </script>

                                                            {{--
                                                            <!-- Tournament Board minutes --> --}}
                                                            <div class="mb-3">
                                                                <label for="t_board_time" class="form-label">How much
                                                                    time do you want to give participants to solve the
                                                                    tournament question?</label>
                                                                <select class="form-select" name="t_board_time" id="t_board_time">
                                                                    <option selected disabled>Select minutes</option>
                                                                    <option value="30">30 minutes</option>
                                                                    <option value="15">15 minutes</option>
                                                                    <option value="45">45 minutes</option>
                                                                </select>
                                                            </div>

                                                            {{--
                                                            <!-- Tournament End Date & Time --> --}}
                                                            <div class="mb-3">
                                                                <label for="t_end_date_time" class="form-label">End Date
                                                                    & Time</label>
                                                                <input type="datetime-local" class="form-control" name="t_end_date_time" id="t_end_date_time" readonly>
                                                            </div>

                                                            {{--
                                                            <!-- Tournament Programming Language --> --}}
                                                            <div class="mb-3">
                                                                <label for="t_Plang" class="form-label">Tournament
                                                                    Programming Language</label>
                                                                <select class="form-select" name="t_Plang" id="t_Plang">
                                                                    <option selected disabled>Select Programming
                                                                        Language</option>
                                                                    <option value="node">JS</option>
                                                                    <option value="python">Python</option>
                                                                    <option value="php">PHP</option>
                                                                </select>
                                                            </div>

                                                            {{--
                                                            <!-- Tournament Short describtion --> --}}
                                                            <div class="mb-3">
                                                                <label for="t_description" class="form-label">Tournament
                                                                    Short Description</label>
                                                                <textarea class="form-control" name="t_description" id="t_description" rows="2" placeholder="Describe the tournament short description" required></textarea>
                                                            </div>

                                                            {{--
                                                            <!-- Submit Button --> --}}
                                                            <button type="submit" class="btn btn-primary">Create
                                                                Tournament</button>
                                                        </form>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- End Tournament Popup --}}


                                        {{-- Profile Edit Popup --}}
                                        <div class="modal fade" id="ProfileEdit" tabindex="-1" aria-labelledby="createPostModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="createPostModalLabel">Profile
                                                            Editing</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                                                            <div class="avatar-container">
                                                                <img id="avatar" class="avatar" src="https://img.freepik.com/premium-photo/beautiful-anime-boy_1284283-122.jpg" alt="User Avatar" />
                                                                <div class="edit-overlay">
                                                                    <span>Edit</span>
                                                                    <input type="file" id="file-input" class="file-input" name="profile_image" accept="image/png, image/jpeg" style="display: none;" />
                                                                    @error('profile_image')
                                                                    <p>{{ $message }}</p>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <span>About</span>
                                                            <input type="text" class="form-control" name="user_about" placeholder="e.g. Full Stack Developer">
                                                            @error('user_about')
                                                            <p>{{ $message }}</p>
                                                            @enderror
                                                            <span>City</span>
                                                            <input type="text" class="form-control" name="user_city" placeholder="City">
                                                            @error('user_city')
                                                            <p>{{ $message }}</p>
                                                            @enderror
                                                            <br>
                                                            <input type="submit" class="btn btn-success btn-block">
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- End Profile Edit Popup --}}

                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>

                        <div class="row gutters-sm">
                            <div class="col-sm-6 mb-3">
                                <div class="card-3 h-100">
                                    <div class="card-body-3">
                                        <small>Points ({{ $user->leaderboard }})</small>
                                        <div class="progress mb-3" style="height: 5px">
                                            <div class="progress-bar bg-success" role="progressbar" style="width:{{ $user->leaderboard ?? 0 }}%;" aria-valuenow="{{ $user->leaderboard ?? 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <small>Threads</small>
                                        <div class="progress mb-3" style="height: 5px">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $posting->id ?? 0 }}%" aria-valuenow="{{ $posting->id ?? 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <small>Challenges</small>
                                        <div class="progress mb-3" style="height: 5px">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $challenges->id ?? 0 }}%" aria-valuenow="{{ $challenges->id ?? 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <small>Tournaments</small>
                                        <div class="progress mb-3" style="height: 5px">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $data->id ?? 0 }}%" aria-valuenow="{{ $data->id ?? 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <small>Progress</small>
                                        <div class="progress mb-3" style="height: 5px">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 66%" aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <div class="card-3 h-100">
                                    <div class="card-body-3">
                                        <br>
                                        <div class="progress mb-3" style="height: 5px">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <br>
                                        <div class="progress mb-3" style="height: 5px">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $data->id ?? 0 }}%" aria-valuenow="{{ $data->id ?? 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <br>
                                        <div class="progress mb-3" style="height: 5px">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $posting->id ?? 0 }}%" aria-valuenow="{{ $posting->id ?? 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <br>
                                        <div class="progress mb-3" style="height: 5px">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $challenges->id ?? 0 }}%" aria-valuenow="{{ $challenges->id ?? 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <br>
                                        <div class="progress mb-3" style="height: 5px">
                                            <div class="progress-bar bg-success" role="progressbar" style="width:{{ $user->leaderboard ?? 0 }}%;" aria-valuenow="{{ $user->leaderboard ?? 0 }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            const avatar = document.getElementById('avatar');
            const fileInput = document.getElementById('file-input');

            document.querySelector('.edit-overlay').addEventListener('click', () => {
                fileInput.click();
            });

            fileInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        avatar.src = e.target.result;

                        // Show crop/filter option here
                        // Implement cropper.js or other image cropping/filter libraries
                        // e.g., use Cropper.js for cropping and then save the cropped image
                    };
                    reader.readAsDataURL(file);
                }
            });


            function storeWinner() {
                const tournaments = document.querySelectorAll('.tournament-result');
                const winners = [];

                tournaments.forEach(tournament => {
                    const participantList = tournament.querySelector('.participant-list');
                    const participants = participantList.querySelectorAll('li');

                    if (participants.length > 0) {
                        // Find the highest scorer (first in the list)
                        const highestScorer = participants[0];
                        const tournamentName = tournament.querySelector('div').textContent.trim();

                        winners.push({
                            tournamentName: tournamentName,
                            winnerName: highestScorer.textContent.split('|')[0].trim(),
                            winnerPoints: highestScorer.textContent.split('|')[2].trim(),
                        });
                    }
                });

                // Store winners in localStorage
                localStorage.setItem('tournamentWinners', JSON.stringify(winners));
                alert('Results announced successfully!');
            }

        </script>


        {{--
        <!-- Bootstrap CND JS --> --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
        </script>

        {{--
        <!-- Custom JS --> --}}
        <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js">
        </script>
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
