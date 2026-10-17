<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Riwayat Stok</title>
</head>
<body>
    <h1>Riwayat Stok</h1>
    <a href="{{ route('products.index') }}">Daftar Produk</a> |
    <a href="{{ route('stock.create') }}">+ Transaksi Stok</a>

    @if (session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
        <tr>
            <th>Tanggal</th>
            <th>Produk</th>
            <th>Tipe</th>
            <th>Jumlah</th>
            <th>Catatan</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($movements as $movement)
            <tr>
                <td>{{ $movement->created_at }}</td>
                <td>{{ $movement->product->name ?? '-' }}</td>
                <td>{{ $movement->type }}</td>
                <td>{{ $movement->quantity }}</td>
                <td>{{ $movement->note }}</td>
            </tr>
        @empty
            <tr><td colspan="5">Belum ada transaksi stok.</td></tr>
        @endforelse
        </tbody>
    </table>

    {{ $movements->links() }}
</body>
</html>