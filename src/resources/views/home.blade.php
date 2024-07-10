@extends('layouts.auth')

@section('content')
<div class="container mt-3">
    <!-- 产品详情 -->
    @if(isset($product))
        <h1 class="text-center">产品详情 "{{ $product->name }}"</h1>
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
                        <p>数量: </p>
                        <input type="number" name="quantity" value="1" min=1>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">添加到购物车</button>
                <a href="{{ url('/products') }}" class="btn btn-primary"><i class="fa fa-angle-left"></i> 继续购物</a>
            </div>
        </form>
    <!-- 产品未找到 -->
    @else

    @endif
</div>

<div class="container">
    <!-- 分类筛选下拉菜单 -->
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="category">按类别筛选：</label>
            <select id="category" class="form-select">
                <option value="">所有类别</option>
                @foreach ($categories as $category)
                <option value="{{ $category }}">{{ $category }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <!-- 价格范围筛选表单 -->
<input type="hidden" name="prange" id="prange" value="" />  


    <div class="row mt-3" id="productList">
        <!-- 产品列表 -->
        @foreach ($products as $product)
        <div class="col-md-4 product-card" data-category="{{ $product->category }}">
            <div class="card py-3 mx-2 my-2 text-center" style="height:450px; position: relative;">
                <div>
                    @if($product->image != '' && file_exists(public_path().'/uploads/products/'.$product->image))
                    <img src="{{ url('uploads/products/'.$product->image) }}" alt="" style="width:250px; height:250px;">
                    @else
                    <img src="{{ url('assets/images/no-image.png') }}" alt="" style="width:250px; height:250px;">
                    @endif
                </div>
                <!-- 显示名称 -->
                <h2>{{ $product->name }}</h2>
                <h4>{{ $product->category }}</h4>
                <p>RM{{ $product->price }}</p>
                <div>
                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-primary" style="color: white; text-decoration: none;">查看详情</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<div class="pagination">
    {{ $products->links() }}
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var categoryDropdown = document.getElementById('category');
        var productCards = document.querySelectorAll('.product-card');

        categoryDropdown.addEventListener('change', function () {
            var selectedCategory = categoryDropdown.value;

            productCards.forEach(function (card) {
                if (selectedCategory === '' || card.getAttribute('data-category') === selectedCategory) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
</script>

@endsection
