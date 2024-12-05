@include('nav.header')
<div class="row">
    <div class="col-md-12">
        <div class="scroll-stylish">
            <div class="heading-leader">
                <h1> Settings </h1>
            </div>

            @if (session('Saved'))
                <div class="alert alert-success">
                    {{ session('Saved') }}
                </div>
            @endif

            @if (session('Updated'))
                <div class="alert alert-success">
                    {{ session('Updated') }}
                </div>
            @endif


            <div class="con">
                <button type="button" class="box" data-toggle="modal" data-target="#accountsModal" id="openModalButton">
                    <div class="icon"><i class="fas fa-user"></i></div>
                    <div class="title">Accounts</div>
                    <div class="description">Manage your account details and connected services</div>
                </button>
                <button type="button" class="box" data-toggle="modal" data-target="#notificationsModal">
                    <div class="icon"><i class="fas fa-bell"></i></div>
                    <div class="title">Notifications</div>
                    <div class="description">Configure how you receive alerts and updates</div>
                </button>
                <button type="button" class="box" data-toggle="modal" data-target="#appearenceModal">
                    <div class="icon"><i class="fas fa-paint-brush"></i></div>
                    <div class="title">Appearance</div>
                    <div class="description">Customize the look and feel of your interface</div>
                </button>
            </div>

            <div class="con">
                <button type="button" class="box" data-toggle="modal" data-target="#privacyModal">
                    <div class="icon"><i class="fas fa-lock"></i></div>
                    <div class="title">Privacy & Security</div>
                    <div class="description">Adjust your privacy settings and secure your account</div>
                </button>
                <button type="button" class="box" data-toggle="modal" data-target="#helpModal">
                    <div class="icon"><i class="fas fa-life-ring"></i></div>
                    <div class="title">Help & Support</div>
                    <div class="description">Get assistance and find answers to your questions</div>
                </button>
                <button type="button" class="box" data-toggle="modal" data-target="#aboutModal">
                    <div class="icon"><i class="fas fa-info-circle"></i></div>
                    <div class="title">About</div>
                    <div class="description">Learn more about our mission and team</div>
                </button>
            </div>

        </div>
    </div>



</div>
</div>


<!-- Accounts Modal -->
<div class="modal fade" id="accountsModal" tabindex="-1" aria-labelledby="createPostModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPostModalLabel">Accounts Settings</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('accoounts',['id' => $user->id]) }}">
                    @csrf
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" id="username" placeholder="Change Username" value="{{ $user->username }}">
                        @error('username')
                        <p>{{ $message }}</p>
                        @enderror
                      </div>
                    <div class="mb-3">
                      <label for="email" class="form-label">Email Address</label>
                      <input type="email" name="email" class="form-control" id="email" placeholder="Change Email" value="{{ $user->email }}">
                      @error('email')
                      <p>{{ $message }}</p>
                      @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                  </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- notifications Modal -->
<div class="modal fade" id="notificationsModal" tabindex="-1" aria-labelledby="createPostModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPostModalLabel">Notifications Settings</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-check form-switch mb-3">
                      <input class="form-check-input" type="checkbox" id="emailNotifications" checked disabled>
                      <label class="form-check-label" for="emailNotifications">Email Notifications</label>
                    </div>
                    <div class="form-check form-switch mb-3">
                      <input class="form-check-input" type="checkbox" id="pushNotifications" checked disabled>
                      <label class="form-check-label" for="pushNotifications">Push Notifications</label>
                    </div>
                    <button type="submit" class="btn btn-warning" disabled>Save Preferences</button>
                  </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>            </div>
        </div>
    </div>
</div>

<!-- appearence Modal -->
<div class="modal fade" id="appearenceModal" tabindex="-1" aria-labelledby="createPostModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPostModalLabel">Appaerance Setting</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('appearence',['id' => $user->id]) }}">
                    @csrf
                    <div class="mb-3">
                      <label for="theme" class="form-label">Theme</label>
                      <select class="form-select" name="Theme" id="theme">
                        <option value="Light" {{ session('Theme') == 'Light' ? 'selected' : '' }}>Light</option>
                        <option value="Dark" {{ session('Theme') == 'Dark' ? 'selected' : '' }}>Dark</option>
                        <option value="Default" {{ session('Theme') == 'Default' ? 'selected' : '' }} selected>Default</option>
                      </select>
                    </div>
                    <div class="form-check mb-3">
                      <input class="form-check-input" type="checkbox" id="animations" checked disabled>
                      <label class="form-check-label" for="animations">Enable Animations</label>
                    </div>
                    <button type="submit" class="btn btn-success">Apply Changes</button>
                  </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>            </div>
        </div>
    </div>
</div>

<!-- privacy Modal -->
<div class="modal fade" id="privacyModal" tabindex="-1" aria-labelledby="createPostModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPostModalLabel">Privacy Setting</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('security',['id' => $user->id]) }}">
                    @csrf
                    <div class="form-check form-switch mb-3">
                      <input class="form-check-input" type="checkbox" id="twoFactorAuth" checked>
                      <label class="form-check-label" for="twoFactorAuth">Enable Two-Factor Authentication</label>
                    </div>
                    <div class="mb-3">
                      <label for="securityQuestions" class="form-label">Security Questions</label>
                      <select class="form-select" name="SQ" id="securityQuestions">
                        <option selected>What was the name of your first pet?</option>
                        <option>What was your first car?</option>
                        <option>What is your mothers maiden name?</option>
                      </select>
                    </div>
                    <div class="form-check form-switch mb-3">
                        <label for="securityQuestions" class="form-label">Answer</label>
                        <input type="text" name="SA" class="form-control" id="answer">
                    </div>
                    <div class="mb-3">
                      <label for="password" class="form-label">Change Password</label>
                      <input type="text" name="password" class="form-control" id="password" placeholder="Change your password">
                      @error('password')
                      <p>{{ $message }}</p>
                      @enderror
                    </div>
                    <button type="submit" class="btn btn-danger">Update Security</button>
                  </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- help Modal -->
<div class="modal fade" id="helpModal" tabindex="-1" aria-labelledby="createPostModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPostModalLabel">Help</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="accordion" id="helpAccordion">
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                          Frequently Asked Questions
                        </button>
                      </h2>
                      <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#helpAccordion">
                        <div class="accordion-body">
                          <strong>Common FAQs:</strong> How to reset password, how to manage notifications, etc.
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                          Contact Support
                        </button>
                      </h2>
                      <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#helpAccordion">
                        <div class="accordion-body">
                          Reach us via email: <a href="mailto:support@example.com">support@example.com</a>
                        </div>
                      </div>
                    </div>
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                          Submit a Ticket
                        </button>
                      </h2>
                      <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#helpAccordion">
                        <div class="accordion-body">
                          Submit a detailed ticket through our <a href="#">Support Portal</a>.
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>            </div>
        </div>
    </div>
</div>

<!-- about Modal -->
<div class="modal fade" id="aboutModal" tabindex="-1" aria-labelledby="createPostModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPostModalLabel">About Us</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="lead">Our platform is designed to provide users with control over their privacy , data & experience. We are passionate about delivering high-quality, user-friendly, & secure solutions.</p>
                <h5>Our Mission</h5>
                <p>Empowering users to protect their privacy & enjoy a customizable experience online.</p>
                <h5>Meet the Team</h5>
                <ul class="list-group">
                  <li class="list-group-item d-flex justify-content-between align-items-center" style="color: black !important;">Minhaj Ur Rehman<span class="badge bg-primary rounded-pill">Founder</span></li>
                  <li class="list-group-item d-flex justify-content-between align-items-center" style="color: black !important;">Qurat ul Ain Javed<span class="badge bg-info rounded-pill">Co - Founder</span></li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap CND JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
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
