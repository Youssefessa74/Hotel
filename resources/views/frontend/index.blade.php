@extends('layouts.app')
@section('content')
    <style>
        .rating {
            display: flex;
            justify-content: center;
            /* Centers the stars horizontally */
            margin: 0 auto;
        }

        .rating .fa {
            color: #fd7792;
            font-size: 1em;
        }

        .rating .fa-star-o {
            color: #e0e0e0;
            /* Gray color for empty stars */
        }
    </style>
    <!-- Include Font Awesome -->

    <div class="hero-wrap js-fullheight" style="background-image: url('{{ asset('assets/images') }}/image_2.jpg');"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start"
                data-scrollax-parent="true">
                <div class="col-md-7 ftco-animate">
                    <h2 class="subheading">Welcome to Vacation Rental</h2>
                    <h1 class="mb-4">Rent an apartment for your vacation</h1>
                    <p><a href="#" class="btn btn-primary">Learn more</a> <a href="#"
                            class="btn btn-white">Contact us</a></p>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section ftco-services">
        <div class="container">
            <div class="row">
                @foreach ($hotel as $item)
                    <div class="col-md-4 d-flex services align-self-stretch px-4 ftco-animate">
                        <div class="d-block services-wrap text-center">
                            <div class="img" style="background-image: url({{ asset($item->image) }});"></div>
                            <div class="media-body py-4 px-3">
                                <h3 class="heading">{{ $item->name }}</h3>
                                <!-- Description -->
                                <p class="description">{{ \Illuminate\Support\Str::limit($item->description, 100, '...') }}
                                </p>
                                <!-- Full Description -->
                                <p class="full-description" style="display: none;">{{ $item->description }}</p>
                                <!-- Read More Button -->
                                <a id="read-more-btn" href="javascript:;">read more <span class="fa fa-chevron-right"
                                        style="font-size: 11px;"></span></a>
                            </div>
                            <p><a href="{{ route('hotel_rooms', $item->id) }}" class="btn btn-primary">View rooms</a></p>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="ftco-section bg-light">
        <div class="container-fluid px-md-0">
            <div class="row no-gutters justify-content-center pb-5 mb-3">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <h2>Apartment Room</h2>
                </div>
            </div>
            <div class="row no-gutters">
                @foreach ($apartment as $item)
                    <div class="col-lg-6">
                        <div class="room-wrap d-md-flex">
                            <a href="#" class="img" style="background-image: url({{ asset($item->image) }});"></a>
                            <div class="half left-arrow d-flex align-items-center">
                                <div class="text p-4 p-xl-5 text-center">
                                    <!-- Display average rating as stars -->

                                    @php
                                        $averageRating = $item->averageRating(); // Get the average rating
                                        $fullStars = floor($averageRating); // Full stars
                                        $halfStar = $averageRating - $fullStars >= 0.5; // Half star
                                        $emptyStars = 5 - ceil($averageRating); // Empty stars
                                    @endphp

                                    <div class="rating">
                                        @for ($i = 0; $i < $fullStars; $i++)
                                            <span class="fa fa-star"></span>
                                        @endfor

                                        @if ($halfStar)
                                            <span class="fa fa-star-half-o"></span>
                                        @endif

                                        @for ($i = 0; $i < $emptyStars; $i++)
                                            <span class="fa fa-star-o"></span>
                                        @endfor
                                    </div>

                                    <h3 class="mb-3"><a
                                            href="{{ route('room_details', $item->id) }}">{{ $item->name }}</a></h3>
                                    <ul class="list-accomodation">
                                        <p>Average Rating: {{ $item->averageRating() }}</p>
                                        <li><span>Max:</span> {{ $item->max_persons }} Persons</li>
                                        <li><span>Size:</span>{{ $item->size }}</li>
                                        <li><span>View:</span> {{ $item->view }}</li>
                                        <li><span>Price:</span> {{ $item->price }}</li>
                                        <li><span>Bed:</span> {{ $item->num_beds }}</li>
                                    </ul>
                                    <p class="pt-1"><a href="{{ route('room_details', $item->id) }}"
                                            class="btn-custom px-3 py-2">View Room Details <span
                                                class="icon-long-arrow-right"></span></a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-md-6 wrap-about">
                    <div class="img img-2 mb-4" style="background-image: url({{ asset('assets/images/image_2.jpg') }});">
                    </div>
                    <h2>{{ $titles['what_we_offer_title'] }}</h2>
                    <p>{{ $titles['what_we_offer_second_description'] }}</p>
                </div>
                <div class="col-md-6 wrap-about ftco-animate">
                    <div class="heading-section">
                        <div class="pl-md-5">
                            <h2 class="mb-2">What we offer</h2>
                        </div>
                    </div>
                    <div class="pl-md-5">
                        <p>{{ $titles['what_we_offer_first_description'] }}</p>
                        <div class="row">
                            @foreach ($what_we_offer as $item)
                                <div class="services-2 col-lg-6 d-flex w-100">
                                    <div class="icon d-flex justify-content-center align-items-center">
                                        <!-- Replace the icon with an image -->
                                        <img src="{{ $item->image }}" alt="{{ $item->title }}"
                                            style="width: 80px; height: 80px; border-radius: 50%;">
                                    </div>
                                    <div class="media-body pl-3">
                                        <h3 class="heading">{{ $item->title }}</h3>
                                        <p>{{ $item->description }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-intro" style="background-image: url({{ asset('assets/images') }}/image_2.jpg);"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-9 text-center">
                    <h2>Ready to get started</h2>
                    <p class="mb-4">It’s safe to book online with us! Get your dream stay in clicks or drop us a line with
                        your questions.</p>
                    <p class="mb-0"><a href="#" class="btn btn-primary px-4 py-3">Learn More</a> <a
                            href="{{ route('contact') }}" class="btn btn-white px-4 py-3">Contact us</a></p>
                </div>
            </div>
        </div>
    </section>

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('#read-more-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    var parent = this.closest('.services-wrap');
                    var description = parent.querySelector('.description');
                    var fullDescription = parent.querySelector('.full-description');

                    if (fullDescription.style.display === 'none') {
                        fullDescription.style.display = 'block';
                        this.textContent = 'Read Less';
                    } else {
                        fullDescription.style.display = 'none';
                        description.style.display = 'block';
                        this.textContent = 'Read More';
                    }
                });
            });
        });
    </script>
@endsection
@endsection
