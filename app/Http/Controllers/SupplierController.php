<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::orderByDesc('id')->paginate(10);

        return view('suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'phone' => 'nullable|string|max:30',
            'address' => 'nullable|string|max:1000',
        ]);

        Supplier::create($validated);

        return redirect()
            ->route('suppliers.index')
            ->with('success', 'Supplier berhasil ditambahkan.');
    }

    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'phone' => 'nullable|string|max:30',
            'address' => 'nullable|string|max:1000',
        ]);

        $supplier->update($validated);

        return redirect()
            ->route('suppliers.index')
            ->with('success', 'Supplier berhasil diperbarui.');
    }

    public function destroy(Supplier $supplier)
    {
        try {
            $supplier->delete();

            return redirect()
                ->route('suppliers.index')
                ->with('success', 'Supplier berhasil dihapus.');

        } catch (QueryException $e) {
            return redirect()
                ->route('suppliers.index')
                ->with('error', 'Supplier tidak dapat dihapus karena masih digunakan oleh produk.');
        }
    }
}