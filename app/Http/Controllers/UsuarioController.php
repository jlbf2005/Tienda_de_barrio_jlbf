<?php

namespace App\Http\Controllers;

use App\Models\ProductoTdg;
use App\Models\CategoriaTdg;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UsuarioController extends Controller
{

    private const MIN_ZERO_correcion = 'min:0'; 


    public function index()
    {
        $categorias = CategoriaTdg::orderBy('tipo_producto')->get();
        $productos = ProductoTdg::with('categoria')->orderBy('id', 'desc')->paginate(10);

        return view('usuario', compact('categorias', 'productos'));
    }


    public function storeCategoria(Request $request)
    {
        $data = $request->validate([
            'tipo_producto' => ['required', 'string', 'max:100'],
            'pasillo' => ['nullable', 'integer', self::MIN_ZERO_correcion, 'max:65535'],
        ]);

        CategoriaTdg::create($data);

        return redirect()->route('usuario')->with('ok', 'Categoría creada exitosamente');
    }


    public function storeProducto(Request $request)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:150'],
            'descripcion' => ['required', 'string', 'max:255'],
            'precio' => ['required', 'numeric', self::MIN_ZERO_correcion],
            'stock' => ['required', 'integer', self::MIN_ZERO_correcion],
            'plu' => ['nullable', 'string', 'max:20', 'unique:productos_tdg,plu'],
            'ean' => ['nullable', 'string', 'max:20', 'unique:productos_tdg,ean'],
            'peso' => ['nullable', 'numeric', self::MIN_ZERO_correcion],
            'categoria_id' => ['required', 'exists:categorias_tdg,id'],
        ]);

        ProductoTdg::create($data);

        return redirect()->route('usuario')->with('ok', 'Producto creado exitosamente');
    }


    public function updateProducto(Request $request, ProductoTdg $producto)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:150'],
            'descripcion' => ['required', 'string', 'max:255'],
            'precio' => ['required', 'numeric', self::MIN_ZERO_correcion],
            'stock' => ['required', 'integer', self::MIN_ZERO_correcion],
            'plu' => ['nullable', 'string', 'max:20', Rule::unique('productos_tdg', 'plu')->ignore($producto->id)],
            'ean' => ['nullable', 'string', 'max:20', Rule::unique('productos_tdg', 'ean')->ignore($producto->id)],
            'peso' => ['nullable', 'numeric', self::MIN_ZERO_correcion],
            'categoria_id' => ['required', 'exists:categorias_tdg,id'],
        ]);

        $producto->update($data);

        return redirect()->route('usuario')->with('ok', 'Producto actualizado exitosamente');
    }


    public function destroyProducto(ProductoTdg $producto)
    {
        $producto->delete();

        return redirect()->route('usuario')->with('ok', 'Producto eliminado exitosamente');
    }


    public function destroyCategoria(CategoriaTdg $categoria)
    {

        if ($categoria->productos()->count() > 0) {
            return redirect()->route('usuario')->with('error', 'No se puede eliminar la categoría porque tiene productos asociados');
        }

        $categoria->delete();

        return redirect()->route('usuario')->with('ok', 'Categoría eliminada exitosamente');
    }
}
