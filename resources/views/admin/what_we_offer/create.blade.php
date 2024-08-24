@extends('admin.body.dashboard')
@section('content')
    <div class="card">

        <div class="card-header">Services</div>
        <div class="card-body">
            <div class="card">
                <div class="card-body">

                    <h6 class="card-title">Create A new offer </h6>

                    <form method="POST" action="{{ route('offer_store') }}" enctype="multipart/form-data"
                        class="forms-sample">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputUsername1" class="form-label">Title</label>
                            <input type="text" name="title" class="form-control  @error('title') is-invalid @enderror"
                                id="exampleInputUsername1" autocomplete="off" placeholder="title">
                        </div>
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="mb-3">
                            <label for="exampleInputUsername1" class="form-label">Description</label>
                            <input type="text" name="description"
                                class="form-control  @error('description') is-invalid @enderror" id="exampleInputUsername1"
                                autocomplete="off" placeholder="description">
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
