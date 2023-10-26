<?php

namespace App\Http\Controllers\Admin;

use App\Exports\TransactionExport;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class ExportController extends Controller
{
    public function exportTransaction($type)
    {
        if ($type == 'excel') {
            return Excel::download(new TransactionExport, 'transaction-report.xlsx');
        } else {
            ini_set('max_execution_time', 600);
            $pdf = FacadePdf::loadView('admin.exports.transaction', [
                'orders' =>  Order::orderBy('id', 'DESC')->where('status', '!=', 'Silahkan Lakukan Pembayaran')->filter(request(['search', 'status_filter', 'sort_option']))->get(),
            ])->setPaper('a1', 'landscape');
            return $pdf->download('transaction-report.pdf');
        }
    }
}
