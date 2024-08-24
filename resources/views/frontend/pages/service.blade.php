@extends('layouts.app')
@section('content')

<section class="hero-wrap hero-wrap-2" style="background-image: url({{ asset('assets/images/image_2.jpg') }});" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center">
        <div class="col-md-9 ftco-animate text-center">
            <p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.html">Home <i class="fa fa-chevron-right"></i></a></span> <span>Services <i class="fa fa-chevron-right"></i></span></p>
          <h1 class="mb-0 bread">Services</h1>
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
                </div>
              </div>
            </div>
            @endforeach
      </div>
      </div>
  </section>

  <section class="ftco-section bg-light ftco-no-pt">
          <div class="container">
              <div class="row no-gutters justify-content-center pb-5 mb-3">
        <div class="col-md-7 heading-section text-center ftco-animate">
          <h2>Amenities</h2>
        </div>
      </div>
          <div class="row">
            @foreach ($amenities as $item)
            <div class="services-2 col-md-3 d-flex w-100 ftco-animate">
                <div class="icon d-flex justify-content-center align-items-center">
                    <!-- Replace the icon with an image -->
                    <img src="{{ $item->image }}" alt="{{ $item->title }}" style="width: 80px; height: 80px; border-radius: 50%;">
                </div>
              <div class="media-body pl-3">
                <h3 class="heading">{{ $item->title }}</h3>
                <p>{{ $item->small_description }}</p>
              </div>
            </div>
            @endforeach
      </div>
          </div>
      </section>
@endsection
