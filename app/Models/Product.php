<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $table = 'products';

    // Tabel P4 tidak memiliki kolom updated_at.
    const UPDATED_AT = null;

    protected $fillable = [
        'category_id',
        'sku',
        'name',
        'price',
        'stock',
        'minimum_stock',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function suppliers(): BelongsToMany
    {
        return $this->belongsToMany(
            Supplier::class,
            'product_suppliers',
            'product_id',
            'supplier_id'
        );
    }

    public function stockMovements(): HasMany
    {
        return $this->hasMany(StockMovement::class);
    }
}