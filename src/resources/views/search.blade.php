@extends('layouts.auth')
@section('content')

@if(count($products) > 0)
<div class="container mt-3">
    <h2>Search Results for "{{ $query }}"</h2>
</div>


<div class="container mt-5">
    <div class="row">
        @foreach ($products as $product)
        <div class="col-md-4">
            <div class="card py-3 mx-2  my-2 text-center" style="height:450px;">
                <div>
                    @if($product->image != '' && file_exists(public_path().'/uploads/products/'.$product->image))
                    <img src="{{ url('uploads/products/'.$product->image) }}" alt="" style="width:250px;">
                    @else
                    <img src="{{ url('assets/images/no-image.png') }}" alt="" style="width:250px;">
                    @endif
                </div>
                <h2>{{ $product->name }}</h2>
                <h4>{{ $product->category }}</h4>

                <p>{{ $product->price }}</p>
                <div>
                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary" style="color: white; text-decoration: none;">View Details</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="pagination">
    {{ $products->links() }}
</div>

@else
<h2>No results found for "{{ $query }}"</h2>
@endif
@endsection