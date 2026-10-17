<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class StockMovementController extends Controller
{
    public function index()
    {
        $movements = StockMovement::with(['product', 'user'])
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('stock.index', compact('movements'));
    }

    public function create()
    {
        $products = Product::orderBy('name')->get();

        return view('stock.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'type' => ['required', Rule::in(['IN', 'OUT'])],
            'quantity' => ['required', 'integer', 'min:1'],
            'note' => ['nullable', 'string', 'max:1000'],
        ]);

        try {
            DB::transaction(function () use ($validated) {
                $product = Product::whereKey($validated['product_id'])
                    ->lockForUpdate()
                    ->firstOrFail();

                $quantity = (int) $validated['quantity'];
                $type = $validated['type'];

                if ($type === 'OUT' && $product->stock < $quantity) {
                    throw new \RuntimeException(
                        'Stok tidak cukup. Stok tersedia: ' . $product->stock
                    );
                }

                if ($type === 'IN') {
                    $product->stock += $quantity;
                } else {
                    $product->stock -= $quantity;
                }

                $product->save();

                // Gunakan pengguna yang login, atau pengguna pertama
                // yang sudah ada di database jika login belum diterapkan.
                $userId = Auth::id() ?? DB::table('users')->value('id');

                if (!$userId) {
                    throw new \RuntimeException(
                        'Tidak ada pengguna di tabel users. Tambahkan pengguna terlebih dahulu.'
                    );
                }

                StockMovement::create([
                    'product_id' => $product->id,
                    'user_id' => $userId,
                    'type' => $type,
                    'quantity' => $quantity,
                    'note' => $validated['note'] ?? null,
                ]);
            });

            return redirect()
                ->route('stock.index')
                ->with('success', 'Transaksi stok berhasil disimpan.');

        } catch (\RuntimeException $e) {
            return back()
                ->withInput()
                ->withErrors(['quantity' => $e->getMessage()]);
        }
    }
}