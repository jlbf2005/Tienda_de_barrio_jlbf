<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductoTdg extends Model
{
    protected $table = 'productos_tdg';

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'stock',
        'plu',
        'ean',
        'peso',
        'categoria_id'
    ];

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(CategoriaTdg::class, 'categoria_id');
    }
}
