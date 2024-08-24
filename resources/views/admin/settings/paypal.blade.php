<div class="tab-pane fade show active" id="paypal" role="tabpanel" aria-labelledby="v-paypal-tab">
    <div class="card">
        <div class="card-header">Logo</div>
        <div class="card-body">
            <form action="{{ route('paypal_update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">


                    <div class="form-group">
                        <label for="">PayPal Client ID</label>
                        <input type="text" value="{{ @$settings['paypal_client_id'] }}" name="paypal_client_id" placeholder="PayPal Client ID" class="form-control @error('paypal_client_id') is-invalid @enderror">
                    </div>
                    @error('paypal_client_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                    <div class="form-group">
                        <label for="">PayPal Currency </label>
                        <input type="text" value="{{ @$settings['paypal_currency'] }}" name="paypal_currency" placeholder="PayPal Currency" class="form-control @error('paypal_currency') is-invalid @enderror">
                    </div>
                    @error('paypal_currency')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror

                </div>
                <button type="submit" class="btn btn-primary me-2">Submit</button>
            </form>
        </div>
    </div>
</div>
