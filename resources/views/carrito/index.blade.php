@extends('layouts.app')
@section('content')
<h2>Carrito</h2>
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if($items->count())
    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr>
                <td>{{ $item->producto->nombre ?? 'Producto eliminado' }}</td>
                <td>
                    <form action="{{ route('carrito.update', $item->id) }}" method="POST">
                        @csrf
                        <input type="number" name="cantidad" value="{{ $item->cantidad }}" min="1" style="width:60px;">
                        <button type="submit">Actualizar</button>
                    </form>
                </td>
                <td>${{ $item->producto->precio ?? '-' }}</td>
                <td>${{ ($item->producto->precio ?? 0) * $item->cantidad }}</td>
                <td>
                    <form action="{{ route('carrito.remove', $item->id) }}" method="POST">
                        @csrf
                        <button type="submit">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div>
        <strong>Total: ${{ $items->sum(fn($i) => ($i->producto->precio ?? 0) * $i->cantidad) }}</strong>
    </div>
@else
    <p>El carrito está vacío.</p>
@endif
@endsection
