<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,500,500i,600,600i,700,700i&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Include Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets/css') }}/animate.css">

    <link rel="stylesheet" href="{{ asset('assets/css') }}/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css') }}/owl.theme.default.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css') }}/magnific-popup.css">

    <link rel="stylesheet" href="{{ asset('assets/css') }}/bootstrap-datepicker.css">
    <link rel="stylesheet" href="{{ asset('assets/css') }}/jquery.timepicker.css">

    <link rel="stylesheet" href="{{ asset('assets/css') }}/flaticon.css">
    <link rel="stylesheet" href="{{ asset('assets/css') }}/style.css">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <style>
       .spinner-border {
    display: none; /* Hide spinner by default */
    width: 1.5rem;
    height: 1.5rem;
    border-width: 0.2em;
}

.spinner-button.active .spinner-border {
    display: inline-block; /* Show spinner when active */
}

.spinner-button.active .fa-paper-plane {
    display: none; /* Hide submit icon when spinner is active */
}

    </style>

    <!-- Scripts -->
</head>

<body>

    {{-- Start Wrap --}}

    <div class="wrap">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col d-flex align-items-center">
                    <p class="mb-0 phone"><span class="mailus">Phone no:</span> <a href="#">+00 1234 567</a> or
                        <span class="mailus">email us:</span> <a href="#">emailsample@email.com</a>
                    </p>
                </div>
                <div class="col d-flex justify-content-end">
                    <div class="social-media">
                        <p class="mb-0 d-flex">
                            <a href="#" class="d-flex align-items-center justify-content-center"><span
                                    class="fa fa-facebook"><i class="sr-only">Facebook</i></span></a>
                            <a href="#" class="d-flex align-items-center justify-content-center"><span
                                    class="fa fa-twitter"><i class="sr-only">Twitter</i></span></a>
                            <a href="#" class="d-flex align-items-center justify-content-center"><span
                                    class="fa fa-instagram"><i class="sr-only">Instagram</i></span></a>
                            <a href="#" class="d-flex align-items-center justify-content-center"><span
                                    class="fa fa-dribbble"><i class="sr-only">Dribbble</i></span></a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- End Wrap --}}

    {{-- Start NavBar --}}

    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Vacation<span>Rental</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fa fa-bars"></span> Menu
            </button>
            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <!-- Common navigation items -->
                    <li class="nav-item active"><a href="{{ url('/') }}" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="{{ route('about') }}" class="nav-link">About</a></li>
                    <li class="nav-item"><a href="{{ route('service') }}" class="nav-link">Services</a></li>
                    <li class="nav-item"><a href="{{ route('contact') }}" class="nav-link">Contact</a></li>

                    <!-- Conditional items based on authentication status -->
                    @guest
                        <!-- Display these links if the user is not authenticated -->
                        <li class="nav-item"><a href="{{ url('login') }}" class="nav-link">Login</a></li>
                        <li class="nav-item"><a href="{{ url('register') }}" class="nav-link">Register</a></li>
                    @else
                        <!-- Display these links if the user is authenticated -->
                        <li class="nav-item"><a href="{{ url('my-bookings') }}" class="nav-link">My Bookings</a></li>
                        <li class="nav-item"><span class="nav-link">Hello, {{ Auth::user()->name }}</span></li>
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </li>
                    @endguest
                </ul>

            </div>
        </div>
    </nav>
    <!-- END Navbar -->




    <main class="py-4">
        @yield('content')
    </main>

    {{-- Start Footer --}}

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-3 mb-md-0 mb-4">
                    <h2 class="footer-heading"><a href="#" class="logo">Vacation Rental</a></h2>
                    <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                    <a href="#">Read more <span class="fa fa-chevron-right"
                            style="font-size: 11px;"></span></a>
                </div>
                <div class="col-md-6 col-lg-3 mb-md-0 mb-4">
                    <h2 class="footer-heading">Services</h2>
                    <ul class="list-unstyled">
                        <li><a href="#" class="py-1 d-block">Map Direction</a></li>
                        <li><a href="#" class="py-1 d-block">Accomodation Services</a></li>
                        <li><a href="#" class="py-1 d-block">Great Experience</a></li>
                        <li><a href="#" class="py-1 d-block">Perfect central location</a></li>
                    </ul>
                </div>
                <div class="col-md-6 col-lg-3 mb-md-0 mb-4">
                    <h2 class="footer-heading">Tag cloud</h2>
                    <div class="tagcloud">
                        <a href="#" class="tag-cloud-link">apartment</a>
                        <a href="#" class="tag-cloud-link">home</a>
                        <a href="#" class="tag-cloud-link">vacation</a>
                        <a href="#" class="tag-cloud-link">rental</a>
                        <a href="#" class="tag-cloud-link">rent</a>
                        <a href="#" class="tag-cloud-link">house</a>
                        <a href="#" class="tag-cloud-link">place</a>
                        <a href="#" class="tag-cloud-link">drinks</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-md-0 mb-4">
                    <h2 class="footer-heading">Subcribe</h2>
                    <form action="POST" class="subscribe-form">
                        @csrf
                        <div class="form-group d-flex">
                            <input type="text" name="email" class="form-control rounded-left"
                                placeholder="Enter email address">
                            <button type="submit" class="form-control submit rounded-right spinner-button">
                                <span class="sr-only">Submit</span>
                                <i class="fa fa-paper-plane"></i>
                                <div class="spinner-border" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </button>
                        </div>
                    </form>


                    <h2 class="footer-heading mt-5">Follow us</h2>
                    <ul class="ftco-footer-social p-0">
                        <li class="ftco-animate"><a href="#" data-toggle="tooltip" data-placement="top"
                                title="Twitter"><span class="fa fa-twitter"></span></a></li>
                        <li class="ftco-animate"><a href="#" data-toggle="tooltip" data-placement="top"
                                title="Facebook"><span class="fa fa-facebook"></span></a></li>
                        <li class="ftco-animate"><a href="#" data-toggle="tooltip" data-placement="top"
                                title="Instagram"><span class="fa fa-instagram"></span></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="w-100 mt-5 border-top py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-8">

                        <p class="copyright mb-0">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved | This template is made with <i
                                class="fa fa-heart" aria-hidden="true"></i> by <a href="https://colorlib.com"
                                target="_blank">Colorlib.com</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>
                    <div class="col-md-6 col-lg-4 text-md-right">
                        <p class="mb-0 list-unstyled">
                            <a class="mr-md-3" href="#">Terms</a>
                            <a class="mr-md-3" href="#">Privacy</a>
                            <a class="mr-md-3" href="#">Compliances</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    {{-- End Footer --}}


    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke-miterlimit="10" stroke="#F96D00" />
        </svg></div>






<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="{{ asset('assets/js') }}/jquery.min.js"></script>
    <script src="{{ asset('assets/js') }}/jquery-migrate-3.0.1.min.js"></script>
    <script src="{{ asset('assets/js') }}/popper.min.js"></script>
    <script src="{{ asset('assets/js') }}/bootstrap.min.js"></script>
    <script src="{{ asset('assets/js') }}/jquery.easing.1.3.js"></script>
    <script src="{{ asset('assets/js') }}/jquery.waypoints.min.js"></script>
    <script src="{{ asset('assets/js') }}/jquery.stellar.min.js"></script>
    <script src="{{ asset('assets/js') }}/jquery.animateNumber.min.js"></script>
    <script src="{{ asset('assets/js') }}/bootstrap-datepicker.js"></script>
    <script src="{{ asset('assets/js') }}/jquery.timepicker.min.js"></script>
    <script src="{{ asset('assets/js') }}/owl.carousel.min.js"></script>
    <script src="{{ asset('assets/js') }}/jquery.magnific-popup.min.js"></script>
    <script src="{{ asset('assets/js') }}/scrollax.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="{{ asset('assets/js') }}/google-map.js"></script>
    <script src="{{ asset('assets/js') }}/main.js"></script>

    <!-- Include jQuery (if not already included) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
       $(document).ready(function() {
    $('.subscribe-form').on('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission

        let formData = $(this).serialize(); // Serialize form data
        let $form = $(this); // Reference to the form
        let $submitButton = $form.find('button'); // Reference to the submit button

        $submitButton.addClass('active'); // Add class to show spinner

        $.ajax({
            method: 'POST',
            url: '{{ route('subscribe.route') }}', // Ensure this URL is correct
            data: formData,
            success: function(response) {
                // Show success notification
                toastr.success(response.message, 'Success');
                // Clear the input field
                $form.find('input[name="email"]').val('');
            },
            error: function(xhr, status, error) {
                // Show error notification
                let errorMessage = xhr.responseJSON.message || 'An error occurred';
                toastr.error(errorMessage, 'Error');
            },
            complete: function() {
                $submitButton.removeClass('active'); // Remove class to hide spinner
            }
        });
    });
});

    </script>

@yield('scripts')


</body>

</html>
