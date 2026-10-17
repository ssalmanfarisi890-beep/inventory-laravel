<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Supplier</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            margin: 0;
            padding: 30px;
            color: #1f2937;
        }
        .container {
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 10px;
        }
        .top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #e5e7eb;
            text-align: left;
        }
        th { background: #f9fafb; }
        a, button {
            display: inline-block;
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            cursor: pointer;
            font-size: 14px;
        }
        .add { background: #2563eb; color: white; }
        .edit { background: #f59e0b; color: white; }
        .delete { background: #dc2626; color: white; }
        .message {
            padding: 12px;
            margin-top: 15px;
            border-radius: 5px;
            background: #dcfce7;
            color: #166534;
        }
        .error {
            padding: 12px;
            margin-top: 15px;
            border-radius: 5px;
            background: #fee2e2;
            color: #991b1b;
        }
        .actions { display: flex; gap: 6px; flex-wrap: wrap; }
    </style>
</head>
<body>
<div class="container">
    <div class="top">
        <h2>Data Supplier</h2>
        <a class="add" href="{{ route('suppliers.create') }}">+ Tambah Supplier</a>
    </div>

    <p><a href="{{ route('dashboard') }}">← Kembali ke Dashboard</a></p>

    @if (session('success'))
        <div class="message">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="error">{{ session('error') }}</div>
    @endif

    @if ($errors->any())
        <div class="error">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Nama Supplier</th>
                <th>Telepon</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($suppliers as $supplier)
                <tr>
                    <td>{{ $suppliers->firstItem() + $loop->index }}</td>
                    <td>{{ $supplier->name }}</td>
                    <td>{{ $supplier->phone ?: '-' }}</td>
                    <td>{{ $supplier->address ?: '-' }}</td>
                    <td>
                        <div class="actions">
                            <a class="edit"
                               href="{{ route('suppliers.edit', $supplier->id) }}">
                                Edit
                            </a>

                            <form action="{{ route('suppliers.destroy', $supplier->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus supplier ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="delete" type="submit">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Belum ada data supplier.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top:20px">
        {{ $suppliers->links() }}
    </div>
</div>
</body>
</html>