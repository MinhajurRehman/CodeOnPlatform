@include('Admin.header')


<h2>TOURNAMENTS LISTS</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Owner Email</th>
            <th>Owner Name</th>
            <th>poster</th>
            <th>date & time</th>
            <th>Prizes</th>
            <th>Programming Language</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($tournaments as $tour)

        <tr>
            <td>{{ $tour->t_email }}</td>
            <td>{{ $tour->t_name }}</td>
            <td><img src="{{ asset($tour->t_poster_image) }}" height="50px" width="50px"></td>
            <td>{{ $tour->t_date_time }}</td>
            <td>{{ $tour->t_win_price }}</td>
            <td>{{ $tour->t_Plang }}</td>
            <td>{{ $tour->Status }}</td>
            <td>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Actions
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <a class="dropdown-item" href="{{ url('accept_tournament',$tour->id) }}">Approved</a>
                        <a class="dropdown-item" href="{{ url('reject_tournament',$tour->id) }}">Decline</a>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>



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
