@extends('admin.body.dashboard')
@section('content')
    <div class="card">

        <div class="card-header">Testimonials</div>
        <div class="card-body">
            <div class="card">
                <div class="card-body">

                    <h6 class="card-title">Create A new Testimonial </h6>

                    <form method="POST" action="{{ route('testimonials.store') }}" enctype="multipart/form-data" class="forms-sample">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputUsername1" class="form-label">Full Name</label>
                            <input type="text" name="full_name" class="form-control  @error('full_name') is-invalid @enderror"
                                id="exampleInputUsername1" autocomplete="off" placeholder="full name">
                        </div>
                        @error('full_name')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror


                        <div class="mb-3">
                            <label for="exampleInputUsername1" class="form-label">jop title</label>
                            <input type="text" name="jop_title" class="form-control  @error('jop_title') is-invalid @enderror"
                                id="exampleInputUsername1" autocomplete="off" placeholder="jop title">
                        </div>
                        @error('jop_title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="mb-3">
                            <label for="exampleInputUsername1" class="form-label">Comment</label>
                            <textarea name="comment" class="form-control" id="" cols="30" rows="10"></textarea>
                        </div>
                        @error('comment')
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
