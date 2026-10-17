<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')
            ->orderByDesc('id')
            ->paginate(10);

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:1000',
        ]);

        Category::create($validated);

        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:1000',
        ]);

        $category->update($validated);

        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category)
    {
        try {
            $category->delete();

            return redirect()->route('categories.index')
                ->with('success', 'Kategori berhasil dihapus.');
        } catch (QueryException $e) {
            return redirect()->route('categories.index')
                ->with('error', 'Kategori tidak dapat dihapus karena masih digunakan oleh produk.');
        }
    }
}