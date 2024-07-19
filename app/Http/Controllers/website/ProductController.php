<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productDetails($id)
    {
        $product = Product::find($id);

        $related_product = Product::whereHas('category' ,function($query) use ($product){
            $query->where('id' , $product->category_id);
        })->whereNotIn('id' ,[$product->id])->get();

//        $related_product = Product::where('category_id', $product->category_id)
//            ->where('id', '<>', $product->id)->get();

        return view('website.products.details', ['product' => $product, 'related_product' => $related_product]);
    }
}
