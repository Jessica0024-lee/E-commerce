@extends('layouts.auth')

@section('content')
<table id="cart" class="table table-bordered">
    <thead>
        <tr class="text-center">
            <th>Product</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Subtotal</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @php $total = 0 @endphp
        @if (session('cart'))
        @foreach (session('cart') as $id => $details)
        <tr rowId="{{ $id }}">
            <td data-th="Product">
                <div class="row">
                    <div class="col-sm-2 hidden-xs"><img src="{{ url('uploads/products/'.$details['image']) }}" class="card-img-top" />
                    </div>
                    <div class="col-sm-7">
                        <p class="nomargin">{{ $details['name'] }}</p>
                    </div>
                </div>
            </td>

            <td data-th="Quantity">{{ $details['quantity'] }}</td>
            <td width="150" data-th="Price">RM {{ $details['price'] }}</td>
            <td data-th="Subtotal" class="text-center"> RM {{ $details['quantity'] * $details['price'] }}</td>
            <td class="actions">
                <button class="btn btn-outline-danger btn-sm delete-product"><i class="fa fa-trash-o"></i>
                    Delete</button>
            </td>
        </tr>
        @php $total += $details['quantity'] * $details['price']@endphp
        @endforeach
        @endif
    </tbody>
    <tfoot>

        <tr>
            <td colspan="2" class="text-right">
                <a href="{{ url('/products') }}" class="btn btn-primary"><i class="fa fa-angle-left"></i> Continue
                    Shopping</a>
                <a href="{{ url('/checkout') }}" class="btn btn-danger">Checkout</a>
                <a href="{{ url('/match') }}" class="btn btn-danger">natch</a>

            </td>
            <td>
                <h5>Total: </h5>
            </td>
            <td colspan="3" width="150" data-th="Total">RM {{ $total }}</td>
        </tr>
    </tfoot>
</table>
@endsection

@section('scripts')
<script type="text/javascript">
    $(".edit-cart-info").change(function(e) {
        e.preventDefault();
        var ele = $(this);
        $.ajax({
            url: '{{ route('update.shopping.cart') }}',
            method: "patch",
            data: {
                _token: '{{ csrf_token() }}',
                id: ele.parents("tr").attr("rowId"),
            },
            success: function(response) {
                window.location.reload();
            }
        });
    });

    $(document).ready(function() {
        $(".delete-product").click(function(e) {
            e.preventDefault();
            var ele = $(this);

            if (confirm("Do you really want to delete?")) {
                $.ajax({
                    url: '{{ route('delete.cart.product') }}',
                    method: "DELETE",
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: ele.parents("tr").attr("rowId")
                    },
                    success: function(response) {
                        window.location.reload();
                    }
                });
            }
        });
    })
</script>
@endsection