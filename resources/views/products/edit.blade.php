<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk - Inventory System</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f3f4f6; margin: 0; padding: 30px; }
        .container { max-width: 650px; margin: auto; background: white; padding: 25px; border-radius: 10px; }
        h2 { margin-top: 0; }
        label { display: block; margin-top: 15px; font-weight: bold; }
        input, select { width: 100%; padding: 10px; margin-top: 6px; box-sizing: border-box; border: 1px solid #ccc; border-radius: 5px; }
        button, .back { display: inline-block; margin-top: 20px; padding: 10px 16px; border: 0; border-radius: 5px; color: white; text-decoration: none; cursor: pointer; }
        button { background: #2563eb; }
        .back { background: #6b7280; }
        .error { background: #fee2e2; color: #991b1b; padding: 12px; border-radius: 5px; }
    </style>
</head>
<body>
<div class="container">
    <h2>Edit Produk</h2>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update', $product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>SKU</label>
        <input type="text" name="sku" value="{{ old('sku', $product->sku) }}" required>

        <label>Nama Produk</label>
        <input type="text" name="name" value="{{ old('name', $product->name) }}" required>

        <label>Kategori</label>
        <select name="category_id" required>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <label>Harga</label>
        <input type="number" name="price" min="0" step="0.01"
               value="{{ old('price', $product->price) }}" required>

        <label>Stok</label>
        <input type="number" name="stock" min="0"
               value="{{ old('stock', $product->stock) }}" required>

        <label>Minimum Stok</label>
        <input type="number" name="minimum_stock" min="0"
               value="{{ old('minimum_stock', $product->minimum_stock) }}" required>

        <button type="submit">Simpan Perubahan</button>
        <a class="back" href="{{ route('products.index') }}">Kembali</a>
    </form>
</div>
</body>
</html>