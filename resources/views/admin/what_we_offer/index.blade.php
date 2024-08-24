@extends('admin.body.dashboard')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>Daily offer</h1>
        </div>
        <div class="card-body">
            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                Add
              </button>
              <div class="collapse m-2" id="collapseExample">
                <div class="card card-body">
                    <h6 class="card-title">Create A New One</h6>
                    <form method="POST" action="{{ route('what_we_offer_titles') }}" class="forms-sample">
                        @csrf
                        @method('PUT')


                        <div class="mb-3">
                            <label for="exampleInputUsername1" class="form-label">What We Offer title</label>
                            <input type="text" name="what_we_offer_title" value="{{ @$titles['what_we_offer_title'] }}" class="form-control" id="exampleInputUsername1"
                                autocomplete="off" placeholder="title">
                        </div>
                        @error('what_we_offer_title')
                        <div class="alert alert-danger">{{ $message }}</div>
                         @enderror


                        <div class="mb-3">
                            <label for="exampleInputUsername1" class="form-label">What We Offer First Description</label>
                            <input type="text" name="what_we_offer_first_description" value="{{ @$titles['what_we_offer_first_description'] }}" class="form-control" id="exampleInputUsername1"
                                autocomplete="off" placeholder="title">
                        </div>
                        @error('what_we_offer_first_description')
                        <div class="alert alert-danger">{{ $message }}</div>
                         @enderror


                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">What We Offer Second Description</label>
                            <input type="text" name="what_we_offer_second_description" value="{{ @$titles['what_we_offer_second_description'] }}" class="form-control" id="exampleInputEmail1"
                                placeholder="sub title">
                        </div>
                        @error('daily_offer_main_title')
                       <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="col-md-11 mg-t-5 mg-md-t-0">
                            <input type="file" accept="image/*" name="what_we_offer_image" class="form-control" onchange="loadFile(event)">
                            <br>
                            <input type="hidden" name="what_we_offer_image_old_image"  value="{{ @$titles['what_we_offer_image'] }}">

                            <!-- Existing image preview -->
                            @if (@$titles['what_we_offer_image'])
                                <img style="border-radius:50%" width="150px" height="150px" id="output" src="{{ asset(@$titles['what_we_offer_image']) }}" />
                            @else
                                <img style="border-radius:50%" width="150px" height="150px" id="output" />
                            @endif
                        </div>
                        @error('what_we_offer_image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                         <button type="submit" class="btn btn-primary me-2">Submit</button>
                         </form>
                </div>
              </div>
        </div>
    </div>
</div>
<div class="container">
    <h1>What We Offer</h1>
    <a  style="margin: 25px"  class="btn btn-inverse-primary"
    href="{{ route('offer_create') }}">Create</a>

    {!! $dataTable->table() !!}
</div>

<!-- Include DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

{!! $dataTable->scripts() !!}

<script>
       var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
</script>
@endsection
