<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Order;


class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('customer.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
    // proteksi: customer cuma boleh lihat order milik dia sendiri
        if ($order->user_id !== auth()->id()) {
            abort(403, 'Akses ditolak.');
        }

        $order->load('items.product');

        return view('customer.orders.show', compact('order'));
    }

}
