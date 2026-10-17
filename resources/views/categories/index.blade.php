<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Kategori</title>
    <style>
        body{font-family:Arial;background:#f3f4f6;padding:25px}
        .container{max-width:900px;margin:auto;background:white;padding:25px;border-radius:10px}
        table{width:100%;border-collapse:collapse;margin-top:20px}
        th,td{padding:12px;border-bottom:1px solid #ddd;text-align:left}
        th{background:#f9fafb}
        a,.btn{display:inline-block;padding:9px 12px;border:0;border-radius:5px;color:white;text-decoration:none;cursor:pointer}
        .blue{background:#2563eb}.yellow{background:#d97706}.red{background:#dc2626}.gray{background:#6b7280}
        .success{background:#dcfce7;padding:12px}.error{background:#fee2e2;padding:12px}
        form{display:inline}
    </style>
</head>
<body>
<div class="container">
    <h1>Data Kategori</h1>
    <a class="blue" href="{{ route('dashboard') }}">Dashboard</a>
    <a class="blue" href="{{ route('categories.create') }}">+ Tambah Kategori</a>
    <a class="gray" href="{{ route('products.index') }}">Produk</a>

    @if(session('success'))<p class="success">{{ session('success') }}</p>@endif
    @if(session('error'))<p class="error">{{ session('error') }}</p>@endif

    <table>
        <thead>
        <tr><th>ID</th><th>Nama</th><th>Deskripsi</th><th>Jumlah Produk</th><th>Aksi</th></tr>
        </thead>
        <tbody>
        @forelse($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->description ?? '-' }}</td>
                <td>{{ $category->products_count }}</td>
                <td>
                    <a class="yellow" href="{{ route('categories.edit', $category) }}">Edit</a>
                    <form action="{{ route('categories.destroy', $category) }}" method="POST"
                          onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn red" type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="5">Belum ada kategori.</td></tr>
        @endforelse
        </tbody>
    </table>

    {{ $categories->links() }}
</div>
</body>
</html>