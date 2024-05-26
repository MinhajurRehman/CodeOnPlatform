 @include('nav.header')
   <div class="row">
        <div class="col-md-6">
            <div class="scroll-stylish">
                <div class="post">
                  <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createPostModal" id="openModalButton">
                    <i class="fas fa-plus-circle"></i>
                    Publish Your Thoughts
                  </button>
                </div>

                <!-- Modal -->
  <div class="modal fade" id="createPostModal" tabindex="-1" aria-labelledby="createPostModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createPostModalLabel">Create Post</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="createPostForm" method="post">
            @csrf
            <div class="form-group">
              <label for="postTitle">Attachment</label>
              <input type="file" class="form-control" id="postTitle" name="post_image">
            </div>
            <div class="form-group">
              <label for="postContent">Content</label>
              <textarea class="form-control" id="postContent" rows="3" placeholder="Enter your thoughts" name="post_content"></textarea>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <input type="submit">
        </div>
    </form>
      </div>
    </div>
  </div>


                <br>
                <br>
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-start align-items-center">
                            <img class="rounded-circle shadow-1-strong me-3"
                                  src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(19).webp" alt="avatar" width="60"
                                  height="60" />
                            <div>
                              <h6 class="fw-bold text-primary mb-1">Lily Coleman</h6>
                              <p class="text-muted small mb-0">
                                Shared publicly - Jan 2020
                              </p>
                            </div>
                        </div>

                            <p class="mt-3 mb-4 pb-2">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                quis nostrud exercitation ullamco laboris nisi ut aliquip consequat.
                            </p>

                            <hr>
                    </div>
                            <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
                              <div class="d-flex flex-start w-100">
                                <img class="rounded-circle shadow-1-strong me-3"
                                  src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(19).webp" alt="avatar" width="40"
                                  height="40" />
                                <div data-mdb-input-init class="form-outline w-100">
                                  <textarea class="form-control" id="textAreaExample" rows="4"
                                    style="background: #fff;" placeholder="Leave a Solution"></textarea>
                                </div>
                              </div>
                              <div class="float-end mt-2 pt-1">
                                <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-sm">Post comment</button>
                              </div>
                            </div>
                </div>
                <div class="card">
                  <div class="card-body">
                      <div class="d-flex flex-start align-items-center">
                          <img class="rounded-circle shadow-1-strong me-3"
                                src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(19).webp" alt="avatar" width="60"
                                height="60" />
                          <div>
                            <h6 class="fw-bold text-primary mb-1">Lily Coleman</h6>
                            <p class="text-muted small mb-0">
                              Shared publicly - Jan 2020
                            </p>
                          </div>
                      </div>

                          <p class="mt-3 mb-4 pb-2">
                              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                              tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                              quis nostrud exercitation ullamco laboris nisi ut aliquip consequat.
                          </p>

                          <hr>
                  </div>
                          <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
                            <div class="d-flex flex-start w-100">
                              <img class="rounded-circle shadow-1-strong me-3"
                                src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(19).webp" alt="avatar" width="40"
                                height="40" />
                              <div data-mdb-input-init class="form-outline w-100">
                                <textarea class="form-control" id="textAreaExample" rows="4"
                                  style="background: #fff;" placeholder="Leave a Solution"></textarea>
                              </div>
                            </div>
                            <div class="float-end mt-2 pt-1">
                              <button  type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-sm">Post comment</button>
                            </div>
                          </div>
              </div>
            </div>
        </div>

        <div class="col-md-3 p1">
          <a href="{{ url('/profile') }}">
            <div class="section-nav">
                <i class="fas fa-user"></i>
                <br>
                <Span>Profile</Span>
            </div>
          </a>
          <a href="{{ url('/setting') }}">
            <div class="section-nav">
                <i class="fas fa-cog"></i>
                <br>
                <Span>Setting</Span>
            </div>
          </a>
          <a href="{{ url('/challenge') }}">
            <div class="section-nav">
                <i class="fas fa-fist-raised"></i>
                <br>
                <Span>Challenge 1V1</Span>
            </div>
          </a>



        </div>

        <div class="col-md-3 p1">
            <a href="{{ url('/leaderboard') }}">
              <div class="section-nav">
                  <i class="fas fa-chart-line"></i>
                  <br>
                  <Span>Leaderboard</Span>
              </div>
            </a>
            <a href="{{ url('/search') }}">
              <div class="section-nav">
                  <i class="fas fa-search"></i>
                  <br>
                  <Span>Search</Span>
              </div>
            </a>
            <a href="{{ url('/tournament') }}">
              <div class="section-nav">
                  <i class="fas fa-trophy"></i>
                  <br>
                  <Span>Tournaments</Span>
              </div>
            </a>
          </div>


    </div>
</div>




<!-- Bootstrap CND JS -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script> -->

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<!-- Custom JS -->
<!-- <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script> -->
<script src="js/jquery.min.js"></script>
<script src="js/wow.min.js"></script>
<!-- <script src="js/smoothscroll.js"></script> -->
<script src="js/animsition.js"></script>
<!-- <script src="js/jquery.validate.min.js"></script> -->
<!-- <script src="js/jquery.magnific-popup.min.js"></script> -->
<!-- <script src="js/owl.carousel.min.js"></script> -->
<!-- <script src="js/jquery.pagepiling.min.js"></script> -->

<script src="js/scripts.js"></script>

<!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script> -->
<!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> -->

</body>

<!-- robert/  03:30:37 GMT -->
</html>
