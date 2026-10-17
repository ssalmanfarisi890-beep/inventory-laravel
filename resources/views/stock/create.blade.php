<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Transaksi Stok</title>
</head>
<body>
    <h1>Transaksi Stok Masuk/Keluar</h1>
    <a href="{{ route('stock.index') }}">Kembali ke Riwayat</a>

    @if ($errors->any())
        <ul style="color:red">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('stock.store') }}" method="POST">
        @csrf

        <p>
            <label>Produk</label><br>
            <select name="product_id" required>
                <option value="">-- Pilih Produk --</option>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>
                        {{ $product->sku }} - {{ $product->name }} (Stok: {{ $product->stock }})
                    </option>
                @endforeach
            </select>
        </p>

        <p>
            <label>Tipe Transaksi</label><br>
            <select name="type" required>
                <option value="IN" {{ old('type') == 'IN' ? 'selected' : '' }}>Stok Masuk (IN)</option>
                <option value="OUT" {{ old('type') == 'OUT' ? 'selected' : '' }}>Stok Keluar (OUT)</option>
            </select>
        </p>

        <p>
            <label>Jumlah</label><br>
            <input type="number" name="quantity" min="1" value="{{ old('quantity') }}" required>
        </p>

        <p>
            <label>Catatan</label><br>
            <textarea name="note">{{ old('note') }}</textarea>
        </p>

        <button type="submit">Simpan Transaksi</button>
    </form>
</body>
</html>