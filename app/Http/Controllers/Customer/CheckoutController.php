<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if(count($cart) == 0) {
            return redirect()->route('customer.menu')->with('success', 'Keranjang masih kosong 😄');
        }

        $total = 0;
        foreach($cart as $item){
            $total += $item['price'] * $item['qty'];
        }

        // metode pembayaran
        $paymentMethods = [
            'BCA' => 'Bank BCA',
            'MANDIRI' => 'Bank Mandiri',
            'BRI' => 'Bank BRI',
            'BNI' => 'Bank BNI',
            'DANA' => 'DANA',
            'GOPAY' => 'GO-PAY',
            'SHOPEEPAY' => 'ShopeePay',
            'QRIS' => 'QRIS',
        ];

        return view('customer.checkout.index', compact('cart', 'total', 'paymentMethods'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|string'
        ]);

        $cart = session()->get('cart', []);

        if(count($cart) == 0) {
            return redirect()->route('customer.menu')->with('success', 'Keranjang kosong 😄');
        }

        $total = 0;
        foreach($cart as $item){
            $total += $item['price'] * $item['qty'];
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'order_code' => 'ORD-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6)),
            'total_price' => $total,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
        ]);

        foreach($cart as $item){
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'price' => $item['price'],
                'qty' => $item['qty'],
                'subtotal' => $item['price'] * $item['qty'],
            ]);

            // kurangi stok produk
            $product = Product::find($item['id']);
            if($product){
                $product->stock = max(0, $product->stock - $item['qty']);
                $product->save();
            }
        }

        session()->forget('cart');

        return redirect()->route('customer.orders')->with('success', 'Checkout berhasil ✅ Silakan lakukan pembayaran!');

    }
}
