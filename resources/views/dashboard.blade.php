<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Inventory</title>
    <style>
        body{font-family:Arial;background:#f3f4f6;padding:25px}
        .container{max-width:950px;margin:auto;background:white;padding:25px;border-radius:10px}
        .cards,.menus{display:flex;gap:15px;flex-wrap:wrap;margin:20px 0}
        .card{flex:1;min-width:150px;background:#e5e7eb;padding:18px;border-radius:8px}
        .menus a{background:#2563eb;color:white;padding:12px 16px;border-radius:5px;text-decoration:none}
    </style>
</head>
<body>
<div class="container">
    <h1>Inventory Management System</h1>
    <p>Dashboard pengelolaan persediaan barang.</p>

    <div class="cards">
        <div class="card"><h3>Total Produk</h3><h2>{{ $totalProducts }}</h2></div>
        <div class="card"><h3>Kategori</h3><h2>{{ $totalCategories }}</h2></div>
        <div class="card"><h3>Supplier</h3><h2>{{ $totalSuppliers }}</h2></div>
        <div class="card"><h3>Stok Rendah</h3><h2>{{ $lowStock }}</h2></div>
    </div>

    <h2>Menu Aplikasi</h2>
    <div class="menus">
        <a href="{{ route('products.index') }}">Produk</a>
        <a href="{{ route('categories.index') }}">Kategori</a>
        <a href="{{ route('suppliers.index') }}">Supplier</a>
        <a href="{{ route('stock.index') }}">Riwayat Stok</a>
        <a href="{{ route('stock.create') }}">Transaksi Stok</a>
    </div>
</div>
</body>
</html>