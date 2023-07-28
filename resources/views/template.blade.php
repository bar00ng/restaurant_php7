@php
    $no = 1;
    $totalKeuntungan = 0;
@endphp
<html>
    <head>
        <style>
            table {
                border-collapse: collapse;
                width: 100%;
            }

            table, th, td {
                border: 1px solid black;
            }
        </style>
    </head>
    <body>
        <h2>Laporan Penjualan</h2>
        <span><b>Tanggal Cetak : </b></span>
        <span>{{ \Carbon\Carbon::now()->format('d F Y') }}</span>

        <table style="margin-top: 20px;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tgl. Pesan</th>
                    <th>Tgl. Pembayaran</th>
                    <th>Nama Pemesan</th>
                    <th>Item</th>
                    <th>Total Tagihan (Rp)</th>
                    <th>Total Dibayarkan (Rp)</th>
                    <th>Total Kembalian (Rp)</th>
                    <th>Keuntungan (Rp)</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($data as $d)
                    @php
                        $keuntungan = 0;
                    @endphp
                    <tr>
                        <td style="text-align: center">{{ $no++ }}</td>
                        <td style="text-align: center">{{ \Carbon\Carbon::parse($d->pesanan->tanggal_pesanan)->format('d F Y') }}</td>
                        <td style="text-align: center">{{ \Carbon\Carbon::parse($d->created_at)->format('d F Y') }}</td>
                        <td style="text-align: center">{{ $d->pesanan->pemesan_pesanan }}</td>
                        <td>
                            <ul>
                                @foreach ($d->pesanan->detailPesanan as $detail)
                                    <li>{{ $detail->qty . ' - ' . $detail->menu->nama_menu }} <br> {{ number_format($detail->sub_total) }}</li>
                                    @php
                                        $keuntungan += $detail->sub_total - ($detail->menu->harga_modal_menu * $detail->qty);
                                        $totalKeuntungan += $detail->sub_total - ($detail->menu->harga_modal_menu * $detail->qty);
                                    @endphp
                                @endforeach
                            </ul>
                        </td>
                        <td style="text-align: center">{{ number_format($d->pesanan->total_pesanan) }}</td>
                        <td style="text-align: center">{{ number_format($d->nominal_payment) }}</td>
                        <td style="text-align: center">{{ number_format($d->kembalian_payment) }}</td>
                        <td style="text-align: center">{{ number_format($keuntungan) }}</td>
                    </tr>        
                @endforeach
            </tbody>

            <tfoot>
                <tr>
                    <th colspan="8" style="text-align: left">Total Keuntungan (Rp)</th>
                    <th>{{ number_format($totalKeuntungan) }}</th>
                </tr>
            </tfoot>
        </table>
    </body>
</html>