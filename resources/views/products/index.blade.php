<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Produk - Inventory System</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f3f4f6; margin: 0; padding: 25px; }
        .container { max-width: 1200px; margin: auto; background: white; padding: 25px; border-radius: 10px; overflow-x: auto; }
        h1 { margin-top: 0; }
        .top { display: flex; justify-content: space-between; align-items: center; gap: 12px; flex-wrap: wrap; }
        input { padding: 10px; border: 1px solid #ccc; border-radius: 5px; }
        .btn { display: inline-block; padding: 9px 12px; border-radius: 5px; color: white; text-decoration: none; border: 0; cursor: pointer; font-size: 14px; }
        .blue { background: #2563eb; }
        .yellow { background: #d97706; }
        .red { background: #dc2626; }
        .green { background: #15803d; }
        .gray { background: #6b7280; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; min-width: 850px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #e5e7eb; }
        th { background: #f9fafb; }
        .success { background: #dcfce7; color: #166534; padding: 12px; border-radius: 5px; margin: 15px 0; }
        .error { background: #fee2e2; color: #991b1b; padding: 12px; border-radius: 5px; margin: 15px 0; }
        .actions { display: flex; gap: 6px; align-items: center; }
        .actions form { margin: 0; }
        .pagination { margin-top: 20px; }
    </style>
</head>
<body>
<div class="container">
    <div class="top">
        <h1>Inventory Management System</h1>
        <a class="btn blue" href="{{ route('products.create') }}">+ Tambah Produk</a>
    </div>

    @if (session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="error">{{ session('error') }}</div>
    @endif

    <form action="{{ route('products.index') }}" method="GET">
        <input type="text" name="search" placeholder="Cari nama atau SKU..."
               value="{{ request('search') }}">
        <button class="btn gray" type="submit">Cari</button>
        <a class="btn gray" href="{{ route('products.index') }}">Reset</a>
    </form>

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>SKU</th>
            <th>Nama Produk</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Minimum</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->sku }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->category->name ?? '-' }}</td>
                <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                <td>
                    {{ $product->stock }}
                    @if ($product->stock <= $product->minimum_stock)
                        <strong style="color:#dc2626;">(Stok Rendah)</strong>
                    @endif
                </td>
                <td>{{ $product->minimum_stock }}</td>
                <td>
                    <div class="actions">
                        <a class="btn yellow"
                           href="{{ route('products.edit', $product->id) }}">Edit</a>

                        <form action="{{ route('products.destroy', $product->id) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn red" type="submit">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8">Belum ada produk yang ditemukan.</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div class="pagination">
        {{ $products->links() }}
    </div>
</div>
</body>
</html>