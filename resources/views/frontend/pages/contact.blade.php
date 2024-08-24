@extends('layouts.app')
@section('content')
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
        vertical-align: middle; /* Align with text */
        margin-left: 0.5rem; /* Space between text and spinner */
    }

    .d-none {
        display: none;
    }

    .btn {
        position: relative;
        overflow: hidden; /* Ensure the spinner does not overflow */
    }

    .submitting {
        display: inline-block;
        vertical-align: middle;
        margin-left: 0.5rem; /* Space between spinner and text */
    }
</style>


    <section class="hero-wrap hero-wrap-2" style="background-image: url('{{ asset('/assets/images') }}/image_2.jpg');"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.html">Home <i
                                    class="fa fa-chevron-right"></i></a></span> <span>Contact <i
                                class="fa fa-chevron-right"></i></span></p>
                    <h1 class="mb-0 bread">Contact Us</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-md-8">
                    <div id="map" class="map"></div>
                </div>
                <div class="col-md-4 p-4 p-md-5 bg-white">
                    <h2 class="font-weight-bold mb-4">{{ $titles['contact_title'] }}</h2>
                    <p>{{ $titles['contact_description'] }}</p>
                    <p><a href="{{ url('/') }}" class="btn btn-primary">{{ $titles['contact_button_title'] }}</a></p>
                </div>
                <div class="col-md-12">
                    <div class="wrapper">
                        <div class="row no-gutters">
                            <div class="col-lg-8 col-md-7 d-flex align-items-stretch">
                                <div class="contact-wrap w-100 p-md-5 p-4">
                                    <h3 class="mb-4">Get in touch</h3>
                                    <div id="form-message-warning" class="mb-4"></div>
                                    <div id="form-message-success" class="mb-4">
                                        Contact with us
                                    </div>
                                    <form method="POST" id="contactForm" class="contactForm">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="label" for="name">Full Name</label>
                                                    <input type="text" class="form-control" name="name" id="name"
                                                        placeholder="Name">
                                                    <span id="name-error" class="error-message"></span>
                                                    <!-- Error placeholder -->
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="label" for="email">Email Address</label>
                                                    <input type="email" class="form-control" name="email" id="email"
                                                        placeholder="Email">
                                                    <span id="email-error" class="error-message"></span>
                                                    <!-- Error placeholder -->
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="label" for="subject">Subject</label>
                                                    <input type="text" class="form-control" name="subject" id="subject"
                                                        placeholder="Subject">
                                                    <span id="subject-error" class="error-message"></span>
                                                    <!-- Error placeholder -->
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="label" for="message">Message</label>
                                                    <textarea name="message" class="form-control" id="message" cols="30" rows="4" placeholder="Message"></textarea>
                                                    <span id="message-error" class="error-message"></span>
                                                    <!-- Error placeholder -->
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="submit" id="submit_contact_btn" value="Send Message"
                                                        class="btn btn-primary">
                                                    <span class="spinner-border spinner-border-sm d-none" role="status"
                                                        aria-hidden="true"></span> <!-- Spinner -->
                                                    <span class="submitting d-none"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>


                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-5 d-flex align-items-stretch">
                                    <div class="info-wrap bg-primary w-100 p-md-5 p-4">
                                        <h3>Let's get in touch</h3>
                                        <p class="mb-4">We're open for any suggestion or just to have a chat</p>
                                        <div class="dbox w-100 d-flex align-items-start">
                                            <div class="icon d-flex align-items-center justify-content-center">
                                                <span class="fa fa-map-marker"></span>
                                            </div>
                                            <div class="text pl-3">
                                                <p><span>Address:</span>{{ $contact->address }}</p>
                                            </div>
                                        </div>
                                        <div class="dbox w-100 d-flex align-items-center">
                                            <div class="icon d-flex align-items-center justify-content-center">
                                                <span class="fa fa-phone"></span>
                                            </div>
                                            <div class="text pl-3">
                                                <p><span>Phone:</span> <a href="tel://1234567920">{{ $contact->phone }}</a></p>
                                            </div>
                                        </div>
                                        <div class="dbox w-100 d-flex align-items-center">
                                            <div class="icon d-flex align-items-center justify-content-center">
                                                <span class="fa fa-paper-plane"></span>
                                            </div>
                                            <div class="text pl-3">
                                                <p><span>Email:</span> <a
                                                        href="mailto:info@yoursite.com">{{ $contact->email }}</a></p>
                                            </div>
                                        </div>
                                        <div class="dbox w-100 d-flex align-items-center">
                                            <div class="icon d-flex align-items-center justify-content-center">
                                                <span class="fa fa-globe"></span>
                                            </div>
                                            <div class="text pl-3">
                                                <p><span>Website</span> <a
                                                        href="{{ url('/') }}">{{ $contact->website }}</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection
@section('scripts')
    <script>
      $(document).ready(function() {
    $('#contactForm').on('submit', function(e) {
        e.preventDefault();

        let formData = $(this).serialize();
        let $submitBtn = $('#submit_contact_btn');
        let $spinner = $('.spinner-border');
        let $submitting = $('.submitting');

        $submitBtn.prop('disabled', true); // Disable the button
        $spinner.removeClass('d-none'); // Show the spinner
        $submitting.text('Sending...').removeClass('d-none'); // Show "Sending..." text

        $.ajax({
            method: 'POST',
            url: '{{ route("contact_mail_form") }}',
            data: formData,
            beforeSend: function() {
                // Clear previous error messages
                $('.error-message').text('');
            },
            success: function(response) {
                if (response.success) {
                    $('#form-message-success').text('Your message was sent, thank you!');
                    toastr.success(response.message);
                    $('#contactForm')[0].reset(); // Optionally reset the form
                } else {
                    toastr.error(response.message);
                }
            },
            error: function(xhr) {
                let errors = xhr.responseJSON ? xhr.responseJSON.errors : {};

                // Clear previous error messages
                $('.error-message').text('');

                $.each(errors, function(field, messages) {
                    let errorSelector = `#${field}-error`; // Selector for error messages
                    $(errorSelector).text(messages.join(', '));
                });

                toastr.error('An error occurred during the request.');
            },
            complete: function() {
                $submitBtn.prop('disabled', false); // Re-enable the button
                $spinner.addClass('d-none'); // Hide the spinner
                $submitting.addClass('d-none'); // Hide "Sending..." text
            }
        });
    });
});

    </script>

        <script async defer src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap"></script>
@endsection
