<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $categories = Category::all();
        return view('admin.products.index', compact('products', 'categories'));
    }

    public function store(ProductRequest $request)
    {

        $imageName = $request->image->store('uploads/products', 'public');

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'status' => $request->status,
            'offer_price' => $request->offer_price,
            'category_id' => $request->category_id,
            'offer' => $request->offer,
            'image' => $imageName,
        ]);
        return back()->with('success', 'Product added successfully!');
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'status' => 'required',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $data = $request->except(['image']);
        if ($request->hasFile('image')) {
            // Delete The Old Image
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            // Update Image
            $data['image'] = $request->image->store('uploads/products', 'public');
        }
        $product->update($data);
        return back()->with('success', 'Product updated successfully!');
    }

    public function delete(Request $request, $id)
    {
        $product = Product::find($id);
        $product->delete();
        return back()->with('success', 'Product deleted successfully!');
    }
}
