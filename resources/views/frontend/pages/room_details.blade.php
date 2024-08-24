@extends('layouts.app')
@section('content')
    <!-- Include Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

    <!-- Include jQuery (if not already included) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <style>
        .error-message {
            color: red;
            font-size: 0.875rem;
            display: block;
            margin-top: 0.25rem;
        }
        .spinner-border {
            width: 1rem;
            height: 1rem;
            border-width: 0.2em;
            border-top-color: transparent;
        }
        .d-none {
            display: none;
        }
        .star-rating {
            font-size: 1.5rem;
            color: #ffbc00;
            display: inline-block;
        }
        .star-rating input {
            display: none;
        }
        .star-rating label {
            color: #ccc;
            cursor: pointer;
            display: inline-block;
            font-size: 1.5rem;
        }
        .star-rating label:hover,
        .star-rating label:hover ~ label,
        .star-rating input:checked ~ label {
            color: #fd7792;
        }
        .rating-form {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        .rating-form h3 {
            margin-bottom: 15px;
        }
        .rating-form .form-group {
            margin-bottom: 15px;
        }
        .rating-form .form-control {
            border-radius: 5px;
        }
    </style>


    <div class="hero-wrap js-fullheight" style="background-image: url({{ asset($room->image) }});" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start" data-scrollax-parent="true">
                <div class="col-md-7 ftco-animate">
                    <h2 class="subheading">Welcome to Vacation Rental</h2>
                    <h1 class="mb-4">{{ $room->name }}</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section ftco-book ftco-no-pt ftco-no-pb">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-lg-4">
                    <!-- Booking Form -->
                    <form class="appointment-form check_out_form" style="margin-top: -568px;">
                        @csrf
                        <h3 class="mb-3">Book this room</h3>
                        @auth
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        @endauth
                        <input type="hidden" name="apartment_id" value="{{ $room->id }}">
                        <input type="hidden" name="hotel_id" value="{{ $room->hotel->id }}">
                        <input type="hidden" name="price" value="{{ $room->price }}">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="email" placeholder="Email">
                                    <span class="error-message email-error"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" placeholder="Full Name">
                                    <span class="error-message name-error"></span>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="phone" placeholder="Phone Number">
                                    <span class="error-message phone-error"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-wrap">
                                        <div class="icon"><span class="ion-md-calendar"></span></div>
                                        <input type="text" class="form-control appointment_date-check-in" name="check_in" placeholder="Check-In">
                                        <span class="error-message check_in-error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="input-wrap">
                                        <div class="icon"><span class="ion-md-calendar"></span></div>
                                        <input type="text" class="form-control appointment_date-check-out" name="check_out" placeholder="Check-Out">
                                        <span class="error-message check_out-error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" id="submit-btn" class="btn btn-primary py-3 px-4">
                                        <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                        <span class="btn-text">Book and Pay Now</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                  <!-- Review Form -->
<div class="rating-form">
    <h3 class="mb-3">Leave a Review</h3>
    <form id="review-form" class="review-form">
        @csrf
        <input type="hidden" name="apartment_id" value="{{ $room->id }}">
        <input type="hidden" name="user_id" value="{{ auth()->user()->id ?? null }}">

        <div class="form-group">
            <label for="rating">Rating:</label>
            <div class="star-rating">
                <input type="radio" id="star5" name="rating" value="5"><label for="star5" title="5 stars"><i class="fas fa-star"></i></label>
                <input type="radio" id="star4" name="rating" value="4"><label for="star4" title="4 stars"><i class="fas fa-star"></i></label>
                <input type="radio" id="star3" name="rating" value="3"><label for="star3" title="3 stars"><i class="fas fa-star"></i></label>
                <input type="radio" id="star2" name="rating" value="2"><label for="star2" title="2 stars"><i class="fas fa-star"></i></label>
                <input type="radio" id="star1" name="rating" value="1"><label for="star1" title="1 star"><i class="fas fa-star"></i></label>
            </div>
            <span class="error-message rating-error"></span>
        </div>

        <div class="form-group">
            <textarea class="form-control" name="comment" rows="4" placeholder="Leave a comment (optional)"></textarea>
            <span class="error-message comment-error"></span>
        </div>
        @if(Auth::check())
        <!-- Show submit button if the user is authenticated -->
        <div class="form-group">
            <button type="submit" id="review-submit-btn" class="btn btn-primary">
                <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                <span class="btn-text">Submit Review</span>
            </button>
        </div>
    @else
        <!-- Show message if the user is not authenticated -->
        <p>You should <a href="{{ route('login') }}">log in</a> to submit a review.</p>
    @endif

    </form>
</div>

                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            $('.check_out_form').on('submit', function(e) {
                e.preventDefault();
                let formData = $(this).serialize();
                let $submitBtn = $('#submit-btn');
                let $spinner = $submitBtn.find('.spinner-border');
                let $btnText = $submitBtn.find('.btn-text');

                $submitBtn.prop('disabled', true);
                $spinner.removeClass('d-none');
                $btnText.text('Processing...');

                $.ajax({
                    method: 'POST',
                    url: '{{ route("make_payment") }}',
                    data: formData,
                    beforeSend: function() {
                        $('.error-message').text('');
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message);
                            if (response.redirect_url) {
                                window.location.href = response.redirect_url;
                            } else {
                                toastr.error('Redirect URL is not defined');
                            }
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON ? xhr.responseJSON.errors : {};
                        $('.error-message').text('');
                        $.each(errors, function(field, message) {
                            let errorClass = '.' + field + '-error';
                            $(errorClass).text(message);
                        });
                        toastr.error('An error occurred during the request.');
                    },
                    complete: function() {
                        $submitBtn.prop('disabled', false);
                        $spinner.addClass('d-none');
                        $btnText.text('Book and Pay Now');
                    }
                });
            });

        $('#review-form').on('submit', function(e) {
            e.preventDefault();
            let formData = $(this).serialize();
            let $submitBtn = $('#review-submit-btn');
            let $spinner = $submitBtn.find('.spinner-border');
            let $btnText = $submitBtn.find('.btn-text');

            $submitBtn.prop('disabled', true);
            $spinner.removeClass('d-none');
            $btnText.text('Submitting...');

            $.ajax({
                method: 'POST',
                url: '{{ route("apartment_rate") }}',
                data: formData,
                beforeSend: function() {
                    $('.error-message').text('');
                },
                success: function(response) {
                    if (response.status === 'success') {
                        toastr.success(response.message);
                        $('#review-form')[0].reset(); // Optionally reset the form
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON ? xhr.responseJSON.errors : {};
                    $('.error-message').text('');
                    $.each(errors, function(field, message) {
                        let errorClass = '.' + field + '-error';
                        $(errorClass).text(message);
                    });
                    toastr.error('An error occurred during the request.');
                },
                complete: function() {
                    $submitBtn.prop('disabled', false);
                    $spinner.addClass('d-none');
                    $btnText.text('Submit Review');
                }
            });
        });
    });

    </script>
@endsection
