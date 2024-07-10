<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create New Product</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
</head>

<body>

    <div class="bg-dark py-3">
        <div class="container">
        <div class="h4 text-black">Ecommerce</div>
        </div>
    </div>

    <div class="container ">
        <div class="d-flex justify-content-between py-3">
            <div class="h4">Create New Product</div>
            <div>
                <a href="{{ route('products.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>

        <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card border-0 shadow-lg">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" name="name" id="name" placeholder="Enter Name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                        @error('name')
                        <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Product Price (RM)</label>
                        <input type="text" name="price" id="price" placeholder="Enter Price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}">
                        @error('price')
                        <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-2">
                        <label for="category" class="form-label">Product Category</label>
                        <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
                            <option value="">Select Category</option>
                            <option value="Dress">Dress</option>
                            <option value="Top">Top</option>
                            <option value="Pants">Pants</option>
                            <option value="Short Pants">Short Pants</option>
                            <option value="Others">Others</option>
                        </select>
                        @error('category')
                        <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-3"><br>
                        <label for="image" class="form-label"></label>
                        <input type="file" name="image" id="image" class="@error('image') is-invalid @enderror">

                        @error('image')
                        <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                    </div>


                </div>
            </div>

            <button class="btn btn-primary mt-3">Save Product</button>

        </form>
    </div>


</body>

</html>