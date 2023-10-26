<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnWidths;

class TransactionExport implements FromView, WithColumnWidths
{
    public function view(): View
    {
        ini_set('max_execution_time', 600);
        $orders = Order::orderBy('id', 'DESC')->where('status', '!=', 'Silahkan Lakukan Pembayaran')->filter(request(['search', 'status_filter', 'sort_option']))->get();

        return view('admin.exports.transaction', [
            'orders' => $orders,
        ]);
    }

    public function columnWidths(): array
    {
        return [
            'A' => 8,
            'B' => 35,
            'C' => 35,
            'D' => 25,
            'E' => 25,
            'F' => 14,
            'G' => 25,
        ];
    }
}
