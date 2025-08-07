<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlist = Wishlist::with('product')->where('user_id', Auth::id())->get();
        return view('wishlist.index', compact('wishlist'));
    }

    public function add(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $product = Product::findOrFail($request->product_id);

        $exists = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $product->id)->exists();

        if (!$exists) {
            Wishlist::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
            ]);
            return redirect()->route('wishlist.index')->with('success', $product->name . ' has been added to your wishlist.');
        }

        return redirect()->route('wishlist.index')->with('info', $product->name . ' is already in your wishlist.');
    }

    public function remove($id)
    {
        $wishlist = Wishlist::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $productName = $wishlist->product->name;
        $wishlist->delete();

        return redirect()->route('wishlist.index')->with('danger', $productName . ' has been removed from your wishlist.');
    }
}
