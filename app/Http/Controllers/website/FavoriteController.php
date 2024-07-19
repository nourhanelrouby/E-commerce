<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class FavoriteController extends Controller
{
    public function addFavorite(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'product_id' => 'required|exists:products,id',
        ]);
        // Check If Product Already Exists for Same User
        $favorite = Favorite::where('user_id', $request->user_id)
            ->where('product_id', $request->product_id)
            ->first();

        if ($favorite) {
            $favorite->delete();

            Alert::warning('Warning Message', 'Product removed from favorites successfully');
        } else {
            Favorite::create([
                'user_id' => $request->user_id,
                'product_id' => $request->product_id,
            ]);

            Alert::success('Success Message', 'Product added to favorites successfully');
        }
        return back();
    }

    public function userFavorites()
    {
        $favorites = Favorite::with('product')->get();
        return view('website.products.favorites', ['favorites' => $favorites]);
    }
}
