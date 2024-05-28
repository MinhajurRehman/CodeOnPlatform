@include('nav.header')
<div class="row">
    <div class="col-md-12">
        <div class="scroll-stylish">
            <div class="heading-leader">
                <h1> Settings </h1>
            </div>

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
                <h5 class="modal-title" id="createPostModalLabel">Create Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createPostForm">
                    <div class="form-group">
                        <label for="postTitle">Title</label>
                        <input type="text" class="form-control" id="postTitle" placeholder="Enter title">
                    </div>
                    <div class="form-group">
                        <label for="postContent">Content</label>
                        <textarea class="form-control" id="postContent" rows="3" placeholder="Enter your thoughts"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="savePostButton">Save Post</button>
            </div>
        </div>
    </div>
</div>

<!-- notifications Modal -->
<div class="modal fade" id="notificationsModal" tabindex="-1" aria-labelledby="createPostModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPostModalLabel">Create Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createPostForm">
                    <div class="form-group">
                        <label for="postTitle">Title</label>
                        <input type="text" class="form-control" id="postTitle" placeholder="Enter title">
                    </div>
                    <div class="form-group">
                        <label for="postContent">Content</label>
                        <textarea class="form-control" id="postContent" rows="3" placeholder="Enter your thoughts"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="savePostButton">Save Post</button>
            </div>
        </div>
    </div>
</div>

<!-- appearence Modal -->
<div class="modal fade" id="appearenceModal" tabindex="-1" aria-labelledby="createPostModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPostModalLabel">Create Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createPostForm">
                    <div class="form-group">
                        <label for="postTitle">Title</label>
                        <input type="text" class="form-control" id="postTitle" placeholder="Enter title">
                    </div>
                    <div class="form-group">
                        <label for="postContent">Content</label>
                        <textarea class="form-control" id="postContent" rows="3" placeholder="Enter your thoughts"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="savePostButton">Save Post</button>
            </div>
        </div>
    </div>
</div>

<!-- privacy Modal -->
<div class="modal fade" id="privacyModal" tabindex="-1" aria-labelledby="createPostModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPostModalLabel">Create Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createPostForm">
                    <div class="form-group">
                        <label for="postTitle">Title</label>
                        <input type="text" class="form-control" id="postTitle" placeholder="Enter title">
                    </div>
                    <div class="form-group">
                        <label for="postContent">Content</label>
                        <textarea class="form-control" id="postContent" rows="3" placeholder="Enter your thoughts"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="savePostButton">Save Post</button>
            </div>
        </div>
    </div>
</div>

<!-- help Modal -->
<div class="modal fade" id="helpModal" tabindex="-1" aria-labelledby="createPostModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPostModalLabel">Create Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createPostForm">
                    <div class="form-group">
                        <label for="postTitle">Title</label>
                        <input type="text" class="form-control" id="postTitle" placeholder="Enter title">
                    </div>
                    <div class="form-group">
                        <label for="postContent">Content</label>
                        <textarea class="form-control" id="postContent" rows="3" placeholder="Enter your thoughts"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="savePostButton">Save Post</button>
            </div>
        </div>
    </div>
</div>

<!-- about Modal -->
<div class="modal fade" id="aboutModal" tabindex="-1" aria-labelledby="createPostModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createPostModalLabel">Create Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="createPostForm">
                    <div class="form-group">
                        <label for="postTitle">Title</label>
                        <input type="text" class="form-control" id="postTitle" placeholder="Enter title">
                    </div>
                    <div class="form-group">
                        <label for="postContent">Content</label>
                        <textarea class="form-control" id="postContent" rows="3" placeholder="Enter your thoughts"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="savePostButton">Save Post</button>
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

<!-- robert/  03:30:37 GMT -->

</html>
