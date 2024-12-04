 @include('nav.header')

 <style>
    /* Notification Container */
.notify {
    background-color: #f9f9f9;
    border-left: 5px solid green; /* Red border for emphasis */
    padding: 15px 20px;
    margin: 10px 0;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease;
}

/* Hover Effect */
.notify:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
}

/* Message Style */
.notify p {
    font-size: 16px;
    color: #333;
    margin: 0 0 10px;
    line-height: 1.5;
    font-family: 'Arial', sans-serif;
}

/* Link Style */
.notify a {
    color: green;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.3s ease;
}

/* Link Hover Effect */
.notify a:hover {
    color: green;
}

/* Time Style */
.notify small {
    display: block;
    font-size: 12px;
    color: #777;
    margin-top: 10px;
    font-style: italic;
}

.post-header, .comment-header {
    display: flex;
    align-items: center;
    gap: 10px;
}

.post-content {
    padding: 15px;
    border: 1px solid green;
    border-radius: 8px;
    background-color: #ffffff82;
    margin-bottom: 10px;
    color: black;
}

.comment {
    padding: 15px;
    border-top: 1px solid #ddd;
    background-color: #fff;
}
.verified-check {
    color: green;
}
.comment-box {
    padding: 15px;
    border: 1px solid #ddd;
    border-radius: 8px;
    background-color: #f9f9f9;
    margin-top: 20px;
}
.comment-box textarea {
    resize: none;
    width: 100%;
    height: 80px;
    margin-bottom: 10px;
}
</style>

 <div class="row">

    <div class="col-md-1"></div>
     <div class="col-md-10">
         <div class="scroll-stylish">
                <div class="heading-leader">
                    <h1> Threads </h1>
                </div>

                {{--  post popoup  --}}
             <!-- Modal -->
             <div class="modal fade" id="createPostModal" tabindex="-1" aria-labelledby="createPostModalLabel"
                 aria-hidden="true">
                 <div class="modal-dialog">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h5 class="modal-title" id="createPostModalLabel">Create Post</h5>
                             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                             </button>
                         </div>
                         <div class="modal-body">
                             <form id="createPostForm" method="post" enctype='multipart/form-data'>
                                 @csrf
                                 <input type="hidden" name="user_id" value="{{ $user->id }}"> {{-- $user->id or $request->user->id --}}
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

             <!-- Report Modal -->
             <div class="modal fade" id="Report" tabindex="-1"
                 aria-labelledby="createPostModalLabel" aria-hidden="true">
                 <div class="modal-dialog">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h5 class="modal-title" id="createPostModalLabel">Report</h5>
                             <button type="button" class="close" data-dismiss="modal"
                                 aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                             </button>
                         </div>
                         <div class="modal-body">
                             <form method="post" action="{{ route('reports') }}" enctype='multipart/form-data'>
                                 @csrf
                                 <div class="form-group">
                                     <label for="Complaint">Complaint</label>
                                     <textarea class="form-control" id="Complaint" rows="3" placeholder="Enter your Complaint" name="complaint"></textarea>
                                 </div>
                                 <div class="form-group">
                                     <label for="Screenshot">Screenshot</label>
                                     <input type="file" name="Screenshot">
                                 </div>
                         </div>
                         <div class="modal-footer">
                             <button type="button" class="btn btn-secondary"
                                 data-dismiss="modal">Close</button>
                             <input type="submit">
                         </div>
                         </form>
                     </div>
                 </div>
             </div>
             {{--  close complain popup  --}}


             @foreach($posting as $post)
                <!-- Main Post -->
                <div class="post-content">
                    <div class="post-header">
                        <img src="{{ asset($post->user->profile_image) }}" width="40px" height="40px" class="rounded-circle" alt="User">
                        <div>
                            <strong>{{ $post->user->username }}</strong> |
                            <small class="text-muted">November 18, 2020</small>
                            @if ($post->user_id == $userId)
                                <small class="text-muted"><a href="{{ route('posting.delete', ['id' => $post->id]) }}"><i class="fa fa-trash"></i></a></small>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <p>{{ $post->post_content }}</p>
                    <img src="{{ asset($post->post_image) }}" width="100%" height="50%">
                    <br>
                    <br>

                <!-- Comments -->
                @foreach ($comments->where('posting_id', $post->id) as $comment)
                <div class="comment">
                    <div class="comment-header">
                        <img src="{{ $comment->profile_image }}" class="rounded-circle" alt="User" height="30px" width="30px">
                        <div>
                            <strong>{{ $comment->username }}</strong> <span class="verified-check">&#10003;</span>
                            <small class="text-muted">commented November 18, 2020</small>
                            @if ($comment->user_id == $userId)
                                <small class="text-muted"><a href="{{ route('Comment.delete', ['id' => $comment->id]) }}"><i class="fa fa-trash"></i></a></small>
                            @endif
                        </div>
                    </div>
                    <p>{{ $comment->comment }}</p>
                </div>
                @endforeach

                <!-- Comment Box -->
                <form method="post" action="{{ route('commentsave') }}">
                    @csrf
                    <div class="comment-box">
                        <input type="hidden" name="posting_id" value="{{ $post->id }}">
                        <textarea class="form-control" name="comment" placeholder="Write a comment..."></textarea>
                        <button type="submit" class="btn btn-primary mt-2">Submit</button>
                    </div>
                </form>
            </div>
            @endforeach



         </div>
     </div>



 </div>
 </div>


 <!-- Plus icon button with dropdown -->
 <div class="plus-icon-container">
   <button class="plus-icon" type="button" data-bs-toggle="dropdown" aria-expanded="false" id="plusIcon">+</button>

   <!-- Dropdown menu -->
   <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="plusIcon">

    <li>
        <a class="dropdown-item" href="#">
            <div class="notifications" onclick="openModal()">
               <i class="fas fa-bell"></i> Notifications
               <div class="badge" id="notificationBadge">{{ $notifications->count() }}</div>
           </div>
        </a>
    </li>



     <li>
        <a class="dropdown-item" href="#createPostModal" data-toggle="modal">
        <i class="fas fa-plus-circle"></i>
        Public Your Thread
         </a>
    </li>


     <li>
        <a class="dropdown-item" href="#Report" data-toggle="modal">
            <i class="fas fa-exclamation-circle"></i>
            Report
        </a>
    </li>


   </ul>
 </div>



<div id="notificationModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        @foreach ($notifications as $notification)
        <div class="notify">
            <p> @if (str_contains($notification->message, 'commented'))
                    <strong>{{ $notification->message }}</strong>
                    <br>
                    <em>{{ $notification->additional_info }}</em> <!-- Display the comment -->
                    @else
                    {{ $notification->message }}
                @endif
             </p>
            <a href="{{ $notification->url }}">View Post</a>
            <small>{{ $notification->created_at->diffForHumans() }}</small>
        </div>
    @endforeach
    </div>
</div>

<script>
    function openModal() {
        document.getElementById('notificationModal').style.display = 'block';

            // Session storage mein set karen ke user ne modal open kar liya hai
    sessionStorage.setItem('notificationsSeen', 'true');

    // Badge ko hide karna
    document.getElementById('notificationBadge').style.display = 'none';
    }

    function closeModal() {
        document.getElementById('notificationModal').style.display = 'none';
    }

    // Page load par check karen ke kya user ne notifications dekhi hain
window.onload = function() {
    if (sessionStorage.getItem('notificationsSeen') === 'true') {
        // Agar modal pehle khola gaya tha, to badge ko hide karen
        document.getElementById('notificationBadge').style.display = 'none';
    }
};

// Modal close karna agar user bahar click kare
window.onclick = function(event) {
    var modal = document.getElementById('notificationModal');
    if (event.target === modal) {
        closeModal();
    }
};

</script>



<!-- Bootstrap CND JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
