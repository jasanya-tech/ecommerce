<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function indexTransaction()
    {
        $title = 'transaction';
        $orders = Order::orderBy('id', 'DESC')->where('status', '!=', 'Silahkan Lakukan Pembayaran')->filter(request(['search', 'status_filter', 'sort_option']))->paginate(10);
        return view('admin.laporan.transaction', compact('orders', 'title'));
    }

    public function indexPengiriman()
    {
        $title = 'pengiriman';
        $orders = Order::orderBy('id', 'DESC')->where('status', '!=', 'Silahkan Lakukan Pembayaran')->filter(request(['search', 'status_filter', 'sort_option']))->paginate(10);
        return view('admin.laporan.pengiriman', compact('orders', 'title'));
    }
}
