<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Get all products from the database and sort them by id in descending order, then paginate them
        $products = Product::orderBy('id', 'DESC')->paginate(10);
        $productsQuery = Product::query();
    
        // Check if category parameter is present in the request
        if ($request->has('category')) {
            $categoryId = $request->input('category');
            // Filter products by category
            $productsQuery->where('category_id', $categoryId);
        }
        // Return the view with the products data
        return view('products.show', ['products' => $products]);
    }

    public function create()
    {
        // Return the view for creating a new product
        return view('products.create');
    }

    public function store(Request $request)
    {
        // Validate the input data
        $validator = Validator::make($request->all(), [
            'image' => 'required|image:gif,png,jpeg,jpg',
            'name' => 'required',
            'price' => 'required | numeric',
            'category' => 'required',
        ]);

        // If validation fails, redirect back to the create page with errors and old input
        if ($validator->fails()) 
        {
            return redirect()->route('products.create')->withErrors($validator)->withInput();   // return w errors
        } 
        
        else 
        {
            // Create a new product with the input data
            $product = Product::create($request->post());

            // Upload image
            if ($request->image) {
                $fileName = $request->image->getClientOriginalName();
                $request->image->move(public_path() . '/uploads/products/', $fileName); // save img in a folder

                // Update the product image filename in the database
                $product->image = $fileName;
                $product->save();
            }

            // Redirect to the products index page with a success message
            return redirect()->route('products.index')->with('success', 'Product added successfully.');
        }
    }

    public function edit(Product $product)
    {
        // Return the view for editing a product with the specified ID
        // $product = product::findOrFail($id);       
        return view('products.edit', ['product' => $product]);
    }

    public function update(Product $product, Request $request)
    {
        // Validate the input data
        $validator = Validator::make($request->all(), [
            'image' => 'sometimes|image:gif,png,jpeg,jpg',
            'name' => 'required',
            'price' => 'required | numeric',
            'category' => 'required',
        ]);

        // If validation fails, redirect back to the edit page with errors and old input
        if ($validator->fails()) {

            return redirect()->route('products.edit', $product->id)->withErrors($validator)->withInput();    // return errors

        } else {
            $product->fill($request->post())->save();

            // Upload image
            if ($request->image) {
                $oldImage = $product->image;

                $fileName = $request->image->getClientOriginalExtension();
                $request->image->move(public_path() . '/uploads/products/', $fileName); // This will save file in a folder

                // Update the product image filename in the database and delete the old one
                $product->image = $fileName;
                $product->save();

                File::delete(public_path() . '/uploads/products/' . $oldImage);
            }

            // Redirect to the products index page with a success message
            return redirect()->route('products.index')->with('success', 'Product updated successfully.');
        }
    }

    public function destroy(Product $product, Request $request)
    {
        //$product = product::findOrFail($id);                
        File::delete(public_path() . '/uploads/products/' . $product->image);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    // User side function
    public function showByCategory(Request $request)
    {
        // Get the search query and category filter from the request
        $query = $request->input('query');
        $category = $request->input('category') ?? null; // initialize to null or a default value if not provided

        // Start building the query to fetch products
        $products = Product::query();

        // Apply the search query to the product query
        if ($query) {
            $products->where('name', 'like', '%' . $query . '%')
                ->orWhere('description', 'like', '%' . $query . '%');
        }

        // Apply the category filter to the product query
        if ($category) {
            $products->where('category', $category);
        }

        // Paginate the results and get distinct categories to display in the sidebar
        $products = $products->paginate(9);
        $categories = Product::distinct()->pluck('category');

        // Return the view with the products, search query, categories, and selected category
        return view('home', [
            'products' => $products,
            'category' => $category,
            'query' => $query,
            'categories' => $categories,
            'selectedCategory' => $category,
        ]);
    }


    public function add(Request $request, Product $product)
    {
        // Add the product to the cart and redirect back to the previous page with a success message
        return redirect()->back()->with('success', 'Product added to cart.');
    }

    public function show($id)
    {
        // Fetch a product by ID and show the details in a view
        $product = Product::find($id);
        return view('products.showDetail', compact('product'));
        //$products = $products->paginate(9);

    }

    public function search(Request $request)
    {
        // Search for products based on a query string and paginate the results
        $query = $request->input('query');
        $products = Product::where('name', 'LIKE', "%{$query}%")->paginate(9);
        return view('search', compact('products', 'query'));
    }
}
