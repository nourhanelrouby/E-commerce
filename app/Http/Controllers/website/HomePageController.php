<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function index()
    {

        $products = Product::with(['category' => function ($q) {
            $q->select('id', 'name');
        }])->where('status', true)->get(['id', 'name', 'price', 'image', 'category_id']);
        return view('website.homepage', [
            'products' => $products
        ]);
    }
}
