@extends('admin.body.dashboard')
@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>News Letters</h2>
        </div>
        <div class="card-body">
            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                Add
              </button>
              <div class="collapse m-2" id="collapseExample">
                <div class="card card-body">
                    <h6 class="card-title">Create A New One</h6>
                    <form method="POST" action="{{ route('send_news_letters') }}" class="forms-sample">
                        @csrf

                        <div class="mb-3">
                            <label for="exampleInputUsername1" class="form-label">Subject</label>
                            <input type="text" name="subject" value="" class="form-control" id="exampleInputUsername1"
                                autocomplete="off" placeholder="subject">
                        </div>
                        @error('subject')
                        <div class="alert alert-danger">{{ $message }}</div>
                         @enderror


                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">message</label>
                            <input type="text" name="message" value="" class="form-control" id="exampleInputEmail1"
                                placeholder="message">
                        </div>
                        @error('message')
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
    <h1>Subscribers</h1>

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
@endsection
