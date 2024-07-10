<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Product</title>
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
            <div class="h4">Edit Product</div>
            <div>
                <a href="{{ route('products.index') }}" class="btn btn-primary">Back</a>
            </div>
        </div>

        <form action="{{ route('products.update',$product->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card border-0 shadow-lg">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" name="name" id="name" placeholder="Enter Name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name',$product->name) }}">
                        @error('name')
                        <p class="invalid-feedback">{{ $message }}</p>    
                        @enderror                        
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Product Price</label>
                        <input type="text" name="price" id="price" placeholder="Enter Price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price',$product->price) }}">
                        @error('price')
                        <p class="invalid-feedback">{{ $message }}</p>    
                        @enderror      
                    </div>

                    <div class="mb-2">
                        <label for="category" class="form-label">Product Topegory</label>
                        <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
                            <option value="Dress" {{ old('category',$product->category) == 'Dress' ? 'selected' : ''}}>Dress</option>
                            <option value="Top" {{ old('category',$product->category) == 'Top' ? 'selected' : ''}}>Top</option>
                            <option value="Pants" {{ old('category',$product->category) == 'Pants' ? 'selected' : ''}}>Pants</option>
                            <option value="Short Pants" {{ old('category',$product->category) == 'Short Pants' ? 'selected' : ''}}>Short Pants</option>
                            <option value="Others" {{ old('category',$product->category) == 'Others' ? 'selected' : ''}}>Others</option>
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
                        
                        <div class="pt-3">
                            @if($product->image != '' && file_exists(public_path().'/uploads/products/'.$product->image))
                            <img src="{{ url('uploads/products/'.$product->image) }}" alt="" width="100" height="100">
                            @endif
                        </div>
                    </div>
                
                </div>
            </div>

            <button class="btn btn-primary my-3">Update Product</button>

        </form>
    </div>

    
</body>
</html>