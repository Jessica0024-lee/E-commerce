@extends('layouts.auth')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Products</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

</head>

<body>
    
    <div class="container">
        <div class="card border-0 shadow-lg">
        <div class="card-body">
                    <input type="text" id="searchInput" class="inp.">
                    <button onclick="searchTable()" class="btn btn-primary" >Search</button>
                </div>

            </div>
        </div>
        <div class="d-flex justify-content-between py-3">
          <div class="h4 text-black">Products</div>
            <div>
                <a href="{{ route('products.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Create Product</a>
            </div>
            <div>
            <a href="{{ url('/createLive') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Create Announcement </a>

        </div>

        <table id="productTable" class="table table-striped">
            <tr>
                <th><a href="#" onclick="sortTable(0)">Product ID</a></th>
                <th>Product Image</th>
                <th><a href="#" onclick="sortTable(2)">Product Name</a></th>
                <th><a href="#" onclick="sortTable(3)">Product Price (RM)</a></th>
                <th><a href="#" onclick="sortTable(4)">Product Category</a></th>
                <th width="155">Action</th>
            </tr>

            @if($products->isNotEmpty())
            @foreach ($products as $product)
            <tr valign="middle">
                <td>{{ $product->id }}</td>
                <td>
                    @if($product->image != '' && file_exists(public_path().'/uploads/products/'.$product->image))
                    <img src="{{ url('uploads/products/'.$product->image) }}" alt="" style="width:60px; height:60px;">
                    @else
                    <img src="{{ url('assets/images/no-image.png') }}" alt="" style="width:60px; height:60px;">
                    @endif
                </td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->category }}</td>
                <td>
                    <a href="{{ route('products.edit',$product->id) }}" class="btn btn-edit btn-sm"><i class="fas fa-edit"></i> Edit</a>
                    <a href="#" onclick="deleteproduct({{$product->id}})" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash-can"></i> Delete</a>

                    <form id="product-delete-action-{{ $product->id }}" action="{{ route('products.destroy',$product->id) }}" method="post">
                        @csrf
                        @method('delete')
                    </form>
                </td>
            </tr>
            @endforeach

            @else
            <tr>
                <td colspan="6">Record Not Found</td>
            </tr>
            @endif

        </table>
        <div class="mt-3">
            {{ $products->links() }}
        </div>
    </div>

</body>

</html>

<script>
    function deleteproduct(id) {
        if (confirm("Are you sure you want to delete?")) {
            document.getElementById('product-delete-action-' + id).submit();
        }
    }

    function searchTable() {
        var input, filter, table, tr, td, i, j, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("productTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td");
            for (j = 0; j < td.length; j++) {
                if (td[j]) {
                    txtValue = td[j].textContent || td[j].innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                        break; // If a column matches, no need to search other columns
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    }

    function sortTable(n) {
        var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.querySelector("table");
        switching = true;
        dir = "desc"; // Default to descending order, i.e., higher to lower price
        while (switching) {
            switching = false;
            rows = table.rows;
            for (i = 1; i < (rows.length - 1); i++) {
                shouldSwitch = false;
                x = rows[i].getElementsByTagName("TD")[n];
                y = rows[i + 1].getElementsByTagName("TD")[n];
                if (n == 3) { // If it's the price column
                    if (dir == "desc") {
                        if (parseFloat(x.innerHTML) < parseFloat(y.innerHTML)) {
                            shouldSwitch = true;
                            break;
                        }
                    } else {
                        if (parseFloat(x.innerHTML) > parseFloat(y.innerHTML)) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                } else { // For other columns, perform string sorting
                    if (dir == "asc") {
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    } else if (dir == "desc") {
                        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                            shouldSwitch = true;
                            break;
                        }
                    }
                }
            }
            if (shouldSwitch) {
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                switchcount++;
            } else {
                if (switchcount == 0 && dir == "desc") {
                    dir = "asc";
                    switching = true;
                }
            }
        }
    }
</script>

@endsection
