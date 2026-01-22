<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // ambil filter tanggal
        $startDate = $request->start_date;
        $endDate   = $request->end_date;

        // query dasar (hanya order PAID)
        $query = Order::where('status', 'paid');

        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [
                Carbon::parse($startDate)->startOfDay(),
                Carbon::parse($endDate)->endOfDay(),
            ]);
        }

        // data utama
        $orders = $query->orderBy('created_at')->get();

        // ringkasan
        $totalRevenue = $orders->sum('total_price');
        $totalOrders  = $orders->count();

        // data chart (group by tanggal)
        $chartData = $orders
            ->groupBy(fn ($order) => $order->created_at->format('Y-m-d'))
            ->map(fn ($row) => $row->sum('total_price'));

        return view('admin.reports.index', [
            'orders'        => $orders,
            'totalRevenue'  => $totalRevenue,
            'totalOrders'   => $totalOrders,
            'chartLabels'   => $chartData->keys(),
            'chartValues'   => $chartData->values(),
            'startDate'     => $startDate,
            'endDate'       => $endDate,
        ]);
    }
}
