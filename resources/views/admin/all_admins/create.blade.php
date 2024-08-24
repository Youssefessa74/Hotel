@extends('admin.body.dashboard')
@section('content')
    <div class="card">

        <div class="card-header">Hotels</div>
        <div class="card-body">
            <div class="card">
                <div class="card-body">

                    <h6 class="card-title">Create A new Admin </h6>

                    <form method="POST" action="{{ route('store.admins') }}" enctype="multipart/form-data" class="forms-sample">
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
                            <label for="exampleInputUsername1" class="form-label">Email</label>
                            <input type="text" name="email" class="form-control  @error('email') is-invalid @enderror"
                                id="exampleInputUsername1" autocomplete="off" placeholder="email">
                        </div>
                        @error('email')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror


                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" autocomplete="off" placeholder="Password">
                        </div>
                        @error('password')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror"
                                id="password_confirmation" autocomplete="off" placeholder="Confirm Password">
                        </div>
                        @error('password_confirmation')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror


                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Role</label>
                            <select class="form-control  @error('role') is-invalid @enderror" name="role"
                                id="role">
                                <option value="admin">admin</option>
                            </select>
                        </div>
                        @error('role')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror


                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Role Level</label>
                            <select class="form-control  @error('role_level') is-invalid @enderror" name="role_level"
                                id="role_level">
                                <option selected disabled value="">Choose The Level</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        @error('role_level')
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
