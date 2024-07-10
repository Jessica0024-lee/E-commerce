@extends('layouts.auth')

@section('content')

<div class="container mb-3">
    <div class="py-5 text-center">
        <h2>Checkout form</h2>
        <p class="lead">Please comfirm your purchased products before checkout!</p>
    </div>
    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            @guest
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted"> Your cart</span>
            </h4>
            @endguest


            @php $total = 0 @endphp
            @if (session('cart'))
            @foreach (session('cart') as $id => $details)

            <ul rowId="{{ $id }}" class="list-group mb-3">
                <li data-th="Product" class="list-group-item d-flex justify-content-between lh-condensed">
                    <div>
                        <h6 class="my-0">Product name</h6>
                        <small class="text-muted">{{ $details['name'] }}</small>
                        <br>
                        <h6 class="my-0">Quantity</h6>
                        <span class="text-muted">{{ $details['quantity'] }}</span>
                        <br>
                        <h6 class="my-0">Subtotal</h6>
                        <span class="text-muted">RM {{ $details['quantity'] * $details['price'] }}</span>
                    </div>
                </li>
                @php $total += $details['quantity'] * $details['price']@endphp
            </ul>

            @endforeach
            @endif
            <span>Total (RM): </span>
            <strong>{{$total}}</strong>
        </div>
        <div class="col-md-8 order-md-1">
            <h4 class="mb-3">Billing address</h4>
            <form action="checkout" method="POST">
                @csrf
                <div class="row mb-3">
                    <label for="name" class="col-form-label">{{ __('Name') }}</label>

                    <div>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', Auth::user()->name) }}" required autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="email" class="col-form-label">{{ __('Email Address') }}</label>

                    <div>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', Auth::user()->email) }}" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="phoneNo" class="col-form-label">{{ __('Phone Number') }}</label>

                    <div>
                        <input id="phoneNo" type="text" class="form-control @error('phoneNo') is-invalid @enderror" name="phoneNo" value="{{ old('phoneNo', Auth::user()->phoneNo) }}" required placeholder="01x-xxxxxxxx" autocomplete="phoneNo" autofocus>

                        @error('phoneNo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="address_1" class="col-form-label">{{ __('Address 1') }}</label>

                    <div>
                        <input id="address_1" type="text" class="form-control @error('address_1') is-invalid @enderror" name="address_1" value="{{ old('name', Auth::user()->address) }}" required autocomplete="address" autofocus>

                        @error('address_1')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="address_2" class="col-form-label">{{ __('Address 2 (Optional)') }}</label>

                    <div>
                        <input id="address_2" type="text" class="form-control @error('address_2') is-invalid @enderror" name="address_2" value="{{ old('name') }}" placeholder="Enter your secondary address" autocomplete="address_2" autofocus>

                        @error('address_2')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6 mb-3">
                        <div>
                            <label for="state" class="col-form-label">{{ __('State') }}</label>

                            <div>
                                <select class="custom-select d-block w-100" name="state" id="state" required="">
                                    <option value="">Choose...</option>
                                    <option>Kuala Lumpur</option>
                                    <option>Selangor</option>
                                    <option>Perak</option>
                                    <option>Penang</option>
                                    <option>Sabah</option>
                                    <option>Sarawak</option>
                                </select>

                                @error('state')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="zipcode" class="col-form-label">{{ __('Zipcode') }}</label>

                        <div>
                            <input id="zipcode" type="text" class="form-control @error('zipcode') is-invalid @enderror" name="zipcode" value="{{ old('zipcode') }}" required autocomplete="zipcode" autofocus>

                            @error('zipcode')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <hr class="mb-4">

                <h4 class="mb-3">Payment</h4>
                <div class="d-block my-3">
                    <div class="col-md-4 mb-3">
                        <select class="custom-select d-block w-100" name="payment_method" id="state" required="">
                            <option value="">Choose...</option>
                            <option>PayPal</option>
                            <option>E-wallet</option>
                            <option>Cash On Delivery</option>
                        </select>

                        @error('payment_method')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <hr class="mb-4">
                <button class="btn btn-success btn-lg btn-block" type="submit">Continue to checkout</button>
                <a href="{{ url('/cart') }}" class="btn btn-warning btn-lg btn-block"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Back to Cart </a>
            </form>
        </div>
    </div>
</div>
@endsection