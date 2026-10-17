<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Supplier extends Model
{
    protected $table = 'suppliers';

    const UPDATED_AT = null;

    protected $fillable = [
        'name',
        'phone',
        'address',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(
            Product::class,
            'product_suppliers',
            'supplier_id',
            'product_id'
        );
    }
}