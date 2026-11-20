<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Transaksi #{{ $transaksi->id }}</title>
    <style>
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 12px;
            color: #000;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .struk-container {
            width: 300px;
            margin: 0 auto;
            background: #fff;
            padding: 15px;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .divider {
            border-top: 1px dashed #000;
            margin: 8px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td {
            padding: 2px 0;
            vertical-align: top;
        }
        .no-print {
            text-align: center;
            margin-top: 20px;
        }
        .btn {
            padding: 8px 15px;
            text-decoration: none;
            background: #007bff;
            color: #fff;
            border-radius: 4px;
            border: none;
            cursor: pointer;
            font-family: sans-serif;
            font-size: 13px;
        }
        .btn-secondary { background: #6c757d; }
        .btn-success { background: #28a745; }

        @media print {
            body { background: none; padding: 0; }
            .struk-container { width: 100%; box-shadow: none; padding: 0; }
            .no-print { display: none; }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="struk-container">
        <div class="text-center">
            <h3 style="margin: 0;">TOKO BRAMI</h3>
            <p style="margin: 2px 0;">Struk Pembayaran</p>
        </div>

        <div class="divider"></div>

        <table>
            <tr>
                <td>No. Nota</td>
                <td class="text-right">#{{ str_pad($transaksi->id, 5, '0', STR_PAD_LEFT) }}</td>
            </tr>
            <tr>
                <td>Tanggal</td>
                <td class="text-right">{{ $transaksi->updated_at->format('d/m/Y H:i') }}</td>
            </tr>
            <tr>
                <td>Kasir</td>
                <td class="text-right">{{ $transaksi->kasir_name ?? 'Admin' }}</td>
            </tr>
        </table>

        <div class="divider"></div>

        <table>
            @foreach($transaksi->details as $detail)
            @php
                $namaProduk = $detail->produk->name ?? $detail->produk_name ?? 'Item';
                $hargaSatuan = $detail->harga ?? ($detail->produk->harga ?? ($detail->qty > 0 ? $detail->subtotal / $detail->qty : 0));
            @endphp
            <tr>
                <td colspan="2">{{ $namaProduk }}</td>
            </tr>
            <tr>
                <td>{{ $detail->qty }} x {{ number_format($hargaSatuan, 0, ',', '.') }}</td>
                <td class="text-right">{{ number_format($detail->subtotal, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </table>

        <div class="divider"></div>

        <table>
            <tr>
                <td><strong>TOTAL</strong></td>
                <td class="text-right"><strong>Rp {{ number_format($transaksi->total, 0, ',', '.') }}</strong></td>
            </tr>
            <tr>
                <td>Tunai</td>
                <td class="text-right">Rp {{ number_format($transaksi->dibayarkan, 0, ',', '.') }}</td>
            </tr>
            <tr>
                <td>Kembali</td>
                <td class="text-right">Rp {{ number_format($transaksi->kembalian, 0, ',', '.') }}</td>
            </tr>
        </table>

        <div class="divider"></div>

        <div class="text-center">
            <p style="margin: 5px 0;">Terima Kasih</p>
        </div>
    </div>

    <div class="no-print">
        <button onclick="window.print()" class="btn">Cetak Ulang</button>
        <a href="{{ route('admin.transaksi.edit', $transaksi->id) }}" class="btn btn-secondary">Kembali</a>
        <a href="{{ route('admin.transaksi.create') }}" class="btn btn-success">Transaksi Baru</a>
        <a href="{{ route('admin.transaksi.index') }}" class="btn btn-secondary">Daftar Transaksi</a>
    </div>

</body>
</html>