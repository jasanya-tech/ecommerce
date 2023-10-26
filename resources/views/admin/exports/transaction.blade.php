<table border="1" style="border-spacing: 0; margin: 0 auto;">
    <thead>
        <tr>
            <th scope="col" style="padding: 0.3rem; text-align: center;">No</th>
            <th scope="col" style="padding: 0.3rem; text-align: left;">No Pesanan</th>
            <th scope="col" style="padding: 0.3rem; text-align: left;">No Resi</th>
            <th scope="col" style="padding: 0.3rem; text-align: left;">Tanggal Pesanan</th>
            <th scope="col" style="padding: 0.3rem; text-align: left;">Total Harga Pesanan</th>
            <th scope="col" style="padding: 0.3rem; text-align: left;">Pembayaran</th>
            <th scope="col" style="padding: 0.3rem; text-align: left;">Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($orders as $order)
            <tr>
                <td style="text-align: center; padding: 0.3rem;">{{ $loop->iteration }}</td>
                <td style="padding: 0.3rem;">{{ $order->invoice }}</td>
                <td style="padding: 0.3rem; text-align: left;">{{ $order->no_resi }}</td>
                <td style="padding: 0.3rem; text-align: left;">{{ $order->created_at->timezone('Asia/Jakarta') }}</td>
                <td style="padding: 0.3rem; text-align: left;">{{ GlobalHelper::formatRupiah($order->total) }}</td>
                <td style="padding: 0.3rem; text-align: left;">{{ $order->payment->name }}</td>
                <td style="padding: 0.3rem; text-align: left;">{{ $order->status }}</td>
            </tr>
        @empty
            <p>data tidak tersedia</p>
        @endforelse
    </tbody>
</table>
