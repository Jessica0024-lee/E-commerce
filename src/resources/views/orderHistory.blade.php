@extends('layouts.auth')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h1>Order History</h1>
            <hr>
        </div>
    </div>
    <div class="card border-0 shadow-lg">
        <div class="card-body table-responsive"> <!-- Add table-responsive class here -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Order No</th>
                        <th>Product Id</th>
                        <th>Product Image</th>
                        <th>Product Name</th>
                        <th>Product Quantity</th>
                        <th>Total Price</th>
                        <th>Buyer Name</th>
                        <th>Buyer Email</th>
                        <th>Phone Number</th>
                        <th>address_1</th>
                        <th>address_2</th>
                        <th>State</th>
                        <th>Zipcode</th>
                        <th>Payment</th>
                        <th>Status</th>
                        @if(Gate::allows('change-order-status'))
                            <th>Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @if($orders->isNotEmpty())
                        @foreach ($orders as $count => $order)
                            <tr valign="middle">
                                <td>{{ $count + 1 }}</td>
                                <td>{{ $order->id }}</td>
                                <td>
                                    @if($order->product_image != '' && file_exists(public_path().'/uploads/products/'.$order->product_image))
                                        <img src="{{ url('uploads/products/'.$order->product_image) }}" alt="" style="width:60px; height:60px;" class="img-fluid"> <!-- Add img-fluid class here -->
                                    @else
                                        <img src="{{ url('assets/images/no-image.png') }}" alt="" style="width:60px; height:60px;" class="img-fluid"> <!-- Add img-fluid class here -->
                                    @endif
                                </td>
                                <td>{{ $order->product_name }}</td>
                                <td>{{ $order->product_quantity }}</td>
                                <td>{{ $order->total_price }}</td>
                                <td>{{ $order->name }}</td>
                                <td>{{ $order->email }}</td>
                                <td>{{ $order->phoneNo }}</td>
                                <td>{{ $order->address_1 }}</td>
                                <td>{{ $order->address_2 }}</td>
                                <td>{{ $order->state }}</td>
                                <td>{{ $order->zipcode }}</td>
                                <td>{{ $order->payment_method }}</td>
                                <td>{{ $order->status }}</td>
                                <td>
                                    @if(Gate::allows('change-order-status'))
                                        @if($order->status != 'completed')
                                            <form action="{{ route('orders.markAsCompleted', $order) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success">Mark as Completed</button>
                                            </form>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="15">Record Not Found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .w-5{
        display: none;
    }
</style>

@endsection
