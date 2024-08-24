@extends('admin.body.dashboard')
@section('content')
    <div class="card">
        <div class="card-header">Contact Titles</div>
        <div class="card-body">
            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                Add
              </button>
              <div class="collapse m-2" id="collapseExample">
                <div class="card card-body">
                    <h6 class="card-title">Create A New One</h6>
                    <form method="POST" action="{{ route('contact_titles') }}" class="forms-sample">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="exampleInputUsername1" class="form-label">Contact title</label>
                            <input type="text" name="contact_title" value="{{ @$titles['contact_title'] }}" class="form-control" id="exampleInputUsername1"
                                autocomplete="off" placeholder="title">
                        </div>
                        @error('contact_title')
                        <div class="alert alert-danger">{{ $message }}</div>
                         @enderror


                        <div class="mb-3">
                            <label for="exampleInputUsername1" class="form-label">Contact Description</label>
                            <input type="text" name="contact_description" value="{{ @$titles['contact_description'] }}" class="form-control" id="exampleInputUsername1"
                                autocomplete="off" placeholder="contact description">
                        </div>
                        @error('contact_description')
                        <div class="alert alert-danger">{{ $message }}</div>
                         @enderror


                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Contact Button title</label>
                            <input type="text" name="contact_button_title" value="{{ @$titles['contact_button_title'] }}" class="form-control" id="exampleInputEmail1"
                                placeholder="sub title">
                        </div>
                        @error('contact_button_title')
                       <div class="alert alert-danger">{{ $message }}</div>
                        @enderror


                         <button type="submit" class="btn btn-primary me-2">Submit</button>
                         </form>
                </div>
              </div>
        </div>
        <div class="card-header">Contact</div>
        <div class="card-body">
            <div class="card">
                <div class="card-body">

                    <h6 class="card-title">Create A new Contact </h6>

                    <form method="POST" action="{{ route('store_contacts') }}" enctype="multipart/form-data"
                        class="forms-sample">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputUsername1" class="form-label">Address</label>
                            <input type="text" name="address" value="{{ $contact->address }}" class="form-control  @error('address') is-invalid @enderror"
                                id="exampleInputUsername1" autocomplete="off" placeholder="address">
                        </div>
                        @error('address')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="mb-3">
                            <label for="exampleInputUsername1"  class="form-label">Phone</label>
                            <input type="text" name="phone" value="{{ $contact->phone }}"
                                class="form-control  @error('phone') is-invalid @enderror" id="exampleInputUsername1"
                                autocomplete="off" placeholder="phone">
                        </div>
                        @error('phone')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="mb-3">
                            <label for="exampleInputUsername1" class="form-label">Email</label>
                            <input type="text" name="email" value="{{ $contact->email }}"
                                class="form-control  @error('email') is-invalid @enderror" id="exampleInputUsername1"
                                autocomplete="off" placeholder="email">
                        </div>
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="mb-3">
                            <label for="exampleInputUsername1" class="form-label">Website</label>
                            <input type="text" name="website" value="{{ $contact->website }}"
                                class="form-control  @error('website') is-invalid @enderror" id="exampleInputUsername1"
                                autocomplete="off" placeholder="website">
                        </div>
                        @error('website')
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

