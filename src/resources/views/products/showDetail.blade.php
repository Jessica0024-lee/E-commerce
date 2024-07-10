@extends('layouts.auth')

@section('content')
<div class="container mt-3">
    <h1 class="text-center">Product Details for "{{$product->name }}"</h1>
    <form action="{{ route('add.to.cart', $product->id) }}" method="POST">
        @csrf
        <div class="card mb-2 p-5">
            <div class="row">
                <div class="col-md-4">
                    @if($product->image != '' && file_exists(public_path().'/uploads/products/'.$product->image))
                    <img src="{{ url('uploads/products/'.$product->image) }}" alt="" style="width:250px;">
                    @else
                    <img src="{{ url('assets/images/no-image.png') }}" alt="" style="width:250px;">
                    @endif
                </div>
                <div class="col-md-8" style="text-align: left;">
                    <h2>{{ $product->name }}</h2>
                    <p>{{ $product->category}}</p>
                    <p>RM{{ $product->price }}</p>
                    <br><br>
                    <p>Quantity: </p>
                    <input type="number" name="quantity" value="1" min=1>
                </div>
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Add to Cart</button>
            <a href="{{ url('/products') }}" class="btn btn-primary"><i class="fa fa-angle-left"></i> Continue
                Shopping</a>

        </div>
    </form>
</div>

@endsection