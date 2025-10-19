<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CategoriaTdg extends Model
{
    protected $table = 'categorias_tdg';
    protected $fillable = ['tipo_producto', 'pasillo'];

    public function productos(): HasMany
    {
        return $this->hasMany(ProductoTdg::class, 'categoria_id');
    }
}
