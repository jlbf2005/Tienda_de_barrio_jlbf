<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario - CRUD Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/logoTienda.png') }}">
</head>

<body>
    <header>
        <nav class="navbar bg-dark">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <div>
                    <img src="{{ asset('images/logoTienda.png') }}" alt="Logo Tienda" class="navbar-brand" style="height: 50px;">
                </div>
                <div>
                    <a href="{{ route('inicio') }}" class="btn btn-primary">Cerrar Sesión</a>
                </div>
            </div>
        </nav>
    </header>

    <main class="container py-4">


        @if (session('ok'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('ok') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Revisa los campos:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $e)
                <li>{{ $e }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="row g-4">

            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header">Crear producto</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('usuario.productos.store') }}">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nombre</label>
                                    <input name="nombre" class="form-control" value="{{ old('nombre') }}" required maxlength="150">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Descripción</label>
                                    <input name="descripcion" class="form-control" value="{{ old('descripcion') }}" required maxlength="255">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Precio</label>
                                    <input name="precio" type="number" step="0.01" min="0" class="form-control" value="{{ old('precio') }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Stock</label>
                                    <input name="stock" type="number" min="0" class="form-control" value="{{ old('stock', 0) }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Peso (kg)</label>
                                    <input name="peso" type="number" step="0.001" min="0" class="form-control" value="{{ old('peso') }}">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">PLU</label>
                                    <input name="plu" class="form-control" value="{{ old('plu') }}" maxlength="20">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">EAN</label>
                                    <input name="ean" class="form-control" value="{{ old('ean') }}" maxlength="20">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Categoría</label>
                                    <select name="categoria_id" class="form-select" required>
                                        <option value="" hidden>Seleccione…</option>
                                        @foreach($categorias as $c)
                                        <option value="{{ $c->id }}" @selected(old('categoria_id')==$c->id)>{{ $c->tipo_producto }} @if(!is_null($c->pasillo)) (Pasillo {{ $c->pasillo }}) @endif</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-success">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <div class="col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-header">Crear categoría</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('usuario.categorias.store') }}">
                            @csrf
                            <div class="mb-2">
                                <label class="form-label">Tipo de producto</label>
                                <input name="tipo_producto" class="form-control" required maxlength="100">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Pasillo (opcional)</label>
                                <input name="pasillo" type="number" min="0" class="form-control">
                            </div>
                            <button class="btn btn-outline-primary w-100">Agregar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="card shadow-sm mt-4">
            <div class="card-header">Categorías Registradas</div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tipo de Producto</th>
                            <th>Pasillo</th>
                            <th>Productos Asociados</th>
                            <th style="width: 120px;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categorias as $cat)
                        <tr>
                            <td>{{ $cat->id }}</td>
                            <td><strong>{{ $cat->tipo_producto }}</strong></td>
                            <td>
                                @if($cat->pasillo)
                                <span class="badge bg-info">Pasillo {{ $cat->pasillo }}</span>
                                @else
                                <span class="text-muted">—</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-secondary">{{ $cat->productos->count() }} producto(s)</span>
                            </td>
                            <td>
                                <form class="d-inline" method="POST"
                                    action="{{ route('usuario.categorias.destroy', $cat) }}"
                                    onsubmit="return confirm('¿Eliminar categoría {{ $cat->tipo_producto }}?\n\nNota: Solo se puede eliminar si no tiene productos asociados.')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger"
                                        @if($cat->productos->count() > 0) disabled title="Tiene productos asociados" @endif>
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-3">No hay categorías registradas</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>


        <div class="card shadow-sm mt-4">
            <div class="card-header">Productos</div>
            <div class="table-responsive">
                <table class="table table-striped align-middle mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre / Descripción</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>PLU/EAN</th>
                            <th>Peso</th>
                            <th>Categoría</th>
                            <th style="width: 160px;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($productos as $p)
                        <tr>
                            <td>{{ $p->id }}</td>
                            <td>
                                <strong>{{ $p->nombre }}</strong><br>
                                <small class="text-muted">{{ $p->descripcion }}</small>
                            </td>
                            <td>${{ number_format($p->precio, 2) }}</td>
                            <td>{{ $p->stock }}</td>
                            <td>
                                <div><small>PLU:</small> {{ $p->plu ?? '—' }}</div>
                                <div><small>EAN:</small> {{ $p->ean ?? '—' }}</div>
                            </td>
                            <td>{{ $p->peso ?? '—' }}</td>
                            <td>{{ optional($p->categoria)->tipo_producto ?? '—' }}</td>
                            <td>

                                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#edit-{{ $p->id }}">Editar</button>


                                <form class="d-inline" method="POST" action="{{ route('usuario.productos.destroy', $p) }}" onsubmit="return confirm('¿Eliminar producto?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>


                        <div class="modal fade" id="edit-{{ $p->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                <div class="modal-content">
                                    <form method="POST" action="{{ route('usuario.productos.update', $p) }}">
                                        @csrf @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title">Editar producto #{{ $p->id }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="form-label">Nombre</label>
                                                    <input name="nombre" class="form-control" value="{{ old('nombre', $p->nombre) }}" required maxlength="150">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Descripción</label>
                                                    <input name="descripcion" class="form-control" value="{{ old('descripcion', $p->descripcion) }}" required maxlength="255">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Precio</label>
                                                    <input name="precio" type="number" step="0.01" min="0" class="form-control" value="{{ old('precio', $p->precio) }}" required>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Stock</label>
                                                    <input name="stock" type="number" min="0" class="form-control" value="{{ old('stock', $p->stock) }}" required>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Peso (kg)</label>
                                                    <input name="peso" type="number" step="0.001" min="0" class="form-control" value="{{ old('peso', $p->peso) }}">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">PLU</label>
                                                    <input name="plu" class="form-control" value="{{ old('plu', $p->plu) }}" maxlength="20">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">EAN</label>
                                                    <input name="ean" class="form-control" value="{{ old('ean', $p->ean) }}" maxlength="20">
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label">Categoría</label>
                                                    <select name="categoria_id" class="form-select" required>
                                                        @foreach($categorias as $c)
                                                        <option value="{{ $c->id }}" @selected(old('categoria_id', $p->categoria_id)==$c->id)>
                                                            {{ $c->tipo_producto }} @if(!is_null($c->pasillo)) (Pasillo {{ $c->pasillo }}) @endif
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-primary">Guardar cambios</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">Aún no hay productos</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="card-body">
                {{ $productos->links() }}
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>