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

<section class="hero-wrap hero-wrap-2" style="background-image: url({{ asset('assets/images/image_2.jpg') }});" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center">
        <div class="col-md-9 ftco-animate text-center">
            <p class="breadcrumbs mb-2"><span class="mr-2"><a href="{{ url('/home') }}">Home <i class="fa fa-chevron-right"></i></a></span> <span>Rooms <i class="fa fa-chevron-right"></i></span></p>
          <h1 class="mb-0 bread">Apartment Room</h1>
        </div>
      </div>
    </div>
</section>

<section class="ftco-section bg-light ftco-no-pt ftco-no-pb">
    <div class="container-fluid px-md-0">
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


<p class="mb-0"><span class="price mr-1">{{ $item->price }} $</span> <span class="per">per night</span></p>
                            <h3 class="mb-3"><a href="rooms.html">{{ $item->name }}</a></h3>
                            <ul class="list-accomodation">
                                <li><span>Max:</span>{{ $item->max_persons }} Persons</li>
                                <li><span>Size:</span> {{ $item->size }}</li>
                                <li><span>View:</span> {{ $item->view }}</li>
                                <li><span>Bed:</span>{{ $item->num_beds }}</li>
                            </ul>
                            <p class="pt-1"><a href="{{ route('room_details',$item->id) }}" class="btn-custom px-3 py-2">View Room Details <span class="icon-long-arrow-right"></span></a></p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection
