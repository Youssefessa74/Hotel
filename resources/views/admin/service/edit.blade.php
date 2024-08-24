@extends('admin.body.dashboard')
@section('content')
    <div class="card">

        <div class="card-header">Services</div>
        <div class="card-body">
            <div class="card">
                <div class="card-body">

                    <h6 class="card-title">Update A  Service </h6>

                    <form method="POST" action="{{ route('service_update',$service->id) }}" enctype="multipart/form-data"
                        class="forms-sample">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="exampleInputUsername1" class="form-label">Title</label>
                            <input type="text" name="title" value="{{ $service->title }}" class="form-control  @error('title') is-invalid @enderror"
                                id="exampleInputUsername1" autocomplete="off" placeholder="title">
                        </div>
                        @error('title')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="mb-3">
                            <label for="exampleInputUsername1" class="form-label">Description</label>
                            <input type="text" value="{{ $service->description }}" name="description"
                                class="form-control  @error('description') is-invalid @enderror" id="exampleInputUsername1"
                                autocomplete="off" placeholder="description">
                        </div>
                        @error('description')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Status </label>
                            <select class="form-control  @error('status') is-invalid @enderror" name="status"
                                id="status">
                                <option selected disabled value="">Choose The Status</option>
                                <option @selected($service->status == 1) value="1">Active</option>
                                <option @selected($service->status == 0) value="0">In Active</option>
                            </select>
                        </div>
                        @error('status')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="col-md-11 mg-t-5 mg-md-t-0">
                            <input type="file" accept="image/*" name="image_url" class="form-control" onchange="loadFile(event)">
                            <br>
                            <input type="hidden" name="old_image_url" value="{{ $service->image_url }}">

                            <!-- Existing image preview -->
                            @if ($service->image_url)
                                <img style="border-radius:50%" width="150px" height="150px" id="output" src="{{ asset($service->image_url) }}" />
                            @else
                                <img style="border-radius:50%" width="150px" height="150px" id="output" />
                            @endif
                        </div>
                        @error('image_url')
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
