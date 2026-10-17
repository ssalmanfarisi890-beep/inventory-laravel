<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Supplier</title>
    <style>
        body { font-family:Arial,sans-serif; background:#f3f4f6; margin:0; padding:30px; }
        .container { max-width:600px; margin:auto; background:white; padding:25px; border-radius:10px; }
        label { display:block; margin-top:15px; font-weight:bold; }
        input, textarea { width:100%; box-sizing:border-box; padding:10px; margin-top:6px; border:1px solid #ccc; border-radius:5px; }
        button, .back { display:inline-block; margin-top:20px; padding:10px 16px; border:0; border-radius:5px; text-decoration:none; cursor:pointer; }
        button { background:#2563eb; color:white; }
        .back { background:#e5e7eb; color:#111; }
        .error { color:#dc2626; }
    </style>
</head>
<body>
<div class="container">
    <h2>Edit Supplier</h2>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Nama Supplier *</label>
        <input type="text" name="name" value="{{ old('name', $supplier->name) }}" required>

        <label>Nomor Telepon</label>
        <input type="text" name="phone" value="{{ old('phone', $supplier->phone) }}">

        <label>Alamat</label>
        <textarea name="address" rows="3">{{ old('address', $supplier->address) }}</textarea>

        <button type="submit">Simpan Perubahan</button>
        <a class="back" href="{{ route('suppliers.index') }}">Kembali</a>
    </form>
</div>
</body>
</html>