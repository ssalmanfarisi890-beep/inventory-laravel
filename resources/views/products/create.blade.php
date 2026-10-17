<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Produk</title>
</head>
<body style="font-family: Arial; margin: 30px;">
    <h1>Tambah Produk</h1>

    @if ($errors->any())
        <div style="color: red;">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST">
        @csrf

        <p>SKU</p>
        <input type="text" name="sku" value="{{ old('sku') }}" required>

        <p>Nama Produk</p>
        <input type="text" name="name" value="{{ old('name') }}" required>

        <p>Kategori</p>
        <select name="category_id" required>
            <option value="">-- Pilih Kategori --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <p>Harga</p>
        <input type="number" name="price" min="0" step="0.01"
            value="{{ old('price', 0) }}" required>

        <p>Stok</p>
        <input type="number" name="stock" min="0"
            value="{{ old('stock', 0) }}" required>

        <p>Stok Minimum</p>
        <input type="number" name="minimum_stock" min="0"
            value="{{ old('minimum_stock', 5) }}" required>

        <p>
            <button type="submit">Simpan Produk</button>
            <a href="{{ route('products.index') }}">Kembali</a>
        </p>
    </form>
</body>
</html>