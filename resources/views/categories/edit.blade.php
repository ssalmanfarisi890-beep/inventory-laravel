<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Kategori</title>
</head>
<body style="font-family:Arial;background:#f3f4f6;padding:30px">
<div style="max-width:600px;margin:auto;background:white;padding:25px;border-radius:10px">
    <h1>Edit Kategori</h1>

    @if($errors->any())
        <ul style="color:red">
            @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
        </ul>
    @endif

    <form action="{{ route('categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')
        <p>
            <label>Nama Kategori</label><br>
            <input name="name" value="{{ old('name', $category->name) }}" required maxlength="100"
                   style="width:100%;padding:10px;box-sizing:border-box">
        </p>
        <p>
            <label>Deskripsi</label><br>
            <textarea name="description" maxlength="1000"
                      style="width:100%;padding:10px;box-sizing:border-box">{{ old('description', $category->description) }}</textarea>
        </p>
        <button type="submit">Simpan Perubahan</button>
        <a href="{{ route('categories.index') }}">Kembali</a>
    </form>
</div>
</body>
</html>