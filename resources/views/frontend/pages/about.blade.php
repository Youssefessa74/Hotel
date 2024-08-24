@extends('layouts.app')
@section('content')
    <!-- END nav -->
    <section class="hero-wrap hero-wrap-2" style="background-image: url({{ asset('assets/images/image_2.jpg') }});"
        data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.html">Home <i
                                    class="ion-ios-arrow-forward"></i></a></span> <span>About us <i
                                class="ion-ios-arrow-forward"></i></span></p>
                    <h1 class="mb-0 bread">About Us</h1>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row">
                @foreach ($services as $item)
                    <div class="col-md-4 d-flex services align-self-stretch px-4 ftco-animate">
                        <div class="d-block services-wrap text-center">
                            <div class="img" style="background-image: url({{ asset($item->image_url) }});"></div>
                            <div class="media-body py-4 px-3">
                                <h3 class="heading">{{ $item->title }}</h3>
                                <p>{{ $item->description }}</p>
                                <p><a href="#" class="btn btn-primary">Read more</a></p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="ftco-section testimony-section bg-light">
        <div class="container">
            <div class="row justify-content-center pb-5 mb-3">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <h2>Happy Clients &amp; Feedbacks</h2>
                </div>
            </div>
            <div class="row ftco-animate">
                <div class="col-md-12">
                    <div class="carousel-testimony owl-carousel">
                        @foreach ($testimonials as $item)
                        <div class="item">
                            <div class="testimony-wrap d-flex">
                                <div class="user-img"
                                    style="background-image: url({{ asset($item->image) }})">
                                </div>
                                <div class="text pl-4">
                                    <span class="quote d-flex align-items-center justify-content-center">
                                        <i class="fa fa-quote-left"></i>
                                    </span>
                                    <p>{{ $item->comment }}</p>
                                    <p class="name">{{ $item->full_name }}</p>
                                    <span class="position">{{ $item->jop_title }}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
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
                                        <img src="{{ $item->image }}" alt="{{ $item->title }}" style="width: 80px; height: 80px; border-radius: 50%;">
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
@endsection
