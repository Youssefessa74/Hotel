@extends('admin.body.dashboard')
@section('content')
    <div class="card">

        <div class="card-header">Hotels</div>
        <div class="card-body">
            <div class="card">
                <div class="card-body">

                    <h6 class="card-title">Create A new Hotel </h6>

                    <form method="POST" action="{{ route('store_hotels') }}" enctype="multipart/form-data" class="forms-sample">
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
                            <label for="exampleInputUsername1" class="form-label">Location</label>
                            <input type="text" name="location" class="form-control  @error('location') is-invalid @enderror"
                                id="exampleInputUsername1" autocomplete="off" placeholder="location">
                        </div>
                        @error('location')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror



                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description"  class="form-control   @error('description') is-invalid @enderror" id="">{{ old('description') }}</textarea>
                        </div>
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror


                        <div class="col-md-11 mg-t-5 mg-md-t-0">
                            <input type="file" accept="image/*" name="image" class="form-control"
                                onchange="loadFile(event)">
                            <br>
                            <img style="border-radius:50%" width="150px" height="150px" id="output" />

                        </div>
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
