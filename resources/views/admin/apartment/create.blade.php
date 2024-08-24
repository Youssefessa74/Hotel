@extends('admin.body.dashboard')
@section('content')
    <div class="card">

        <div class="card-header">Apartments</div>
        <div class="card-body">
            <div class="card">
                <div class="card-body">

                    <h6 class="card-title">Create A new Apartment </h6>

                    <form method="POST" action="{{ route('apartments.store') }}" enctype="multipart/form-data" class="forms-sample">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputUsername1" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control  @error('name') is-invalid @enderror"
                                id="exampleInputUsername1" autocomplete="off" placeholder="name">
                        </div>
                        @error('name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror


                        <div class="mb-3">
                            <label for="exampleInputUsername1" class="form-label">Size</label>
                            <input type="text" name="size" class="form-control  @error('size') is-invalid @enderror"
                                id="exampleInputUsername1" autocomplete="off" placeholder="size">
                        </div>
                        @error('size')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="mb-3">
                            <label for="exampleInputUsername1" class="form-label">View</label>
                            <input type="text" name="view" class="form-control  @error('view') is-invalid @enderror"
                                id="exampleInputUsername1" autocomplete="off" placeholder="view">
                        </div>
                        @error('view')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="mb-3">
                            <label for="exampleInputUsername1" class="form-label">Price</label>
                            <input type="text" name="price"  class="form-control  @error('price') is-invalid @enderror"
                                id="exampleInputUsername1" autocomplete="off" placeholder="price">
                        </div>
                        @error('price')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror




                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Max Persons</label>
                            <select class="form-control  @error('max_persons') is-invalid @enderror" name="max_persons"
                                id="max_persons">
                                <option selected disabled value="">Choose The max persons</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        @error('max_persons')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror


                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Hotel</label>
                            <select class="form-control  @error('hotel_id') is-invalid @enderror" name="hotel_id"
                                id="hotel_id">
                                <option selected disabled value="">Choose The Hotel</option>
                                @foreach ($hotels as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('hotel_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Number Of Beds </label>
                            <select class="form-control  @error('num_beds') is-invalid @enderror" name="num_beds"
                                id="num_beds">
                                <option selected disabled value="">Choose The beds number</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        @error('num_beds')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror


                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Status </label>
                            <select class="form-control  @error('status') is-invalid @enderror" name="status"
                                id="status">
                                <option selected disabled value="">Choose The Status</option>
                                <option value="1">Active</option>
                                <option value="0">In Acvtive</option>
                            </select>
                        </div>
                        @error('status')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror


                        <div class="col-md-11 mg-t-5 mg-md-t-0">
                            <input type="file" accept="image/*" name="image" class="form-control"
                                onchange="loadFile(event)">
                            <br>
                            <img style="border-radius:50%" width="150px" height="150px" id="output" />
                        </div>
                        @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                        <br>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
</script>
