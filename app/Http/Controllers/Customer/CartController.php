<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('customer.cart.index', compact('cart'));
    }

    public function add(Product $product)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$product->id])) {
            $cart[$product->id]['qty'] += 1;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'qty' => 1,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Produk ditambahkan ke keranjang ✅');
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'qty' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart', []);

        if(isset($cart[$product->id])) {
            $cart[$product->id]['qty'] = $request->qty;
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Qty produk diupdate ✅');
    }

    public function remove(Product $product)
    {
        $cart = session()->get('cart', []);

        if(isset($cart[$product->id])) {
            unset($cart[$product->id]);
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Produk dihapus dari keranjang ✅');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Keranjang dibersihkan ✅');
    }
}
