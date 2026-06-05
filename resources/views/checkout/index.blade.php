@extends('layouts.app')

@section('title', 'Finalizar Compra')

@section('content')
<div class="cart-container" style="max-width: 1000px; margin: 40px auto; padding: 0 20px;">
    <h1 style="font-size: 2.5rem; margin-bottom: 30px; border-bottom: 2px solid var(--border-color); padding-bottom: 10px;">Finalizar Compra</h1>

    @if(session('error'))
        <div class="alert alert-danger" style="background: rgba(239, 68, 68, 0.1); border-left: 4px solid var(--error-color); padding: 15px; margin-bottom: 20px; border-radius: var(--radius-sm); color: var(--error-color);">
            {{ session('error') }}
        </div>
    @endif

    <div style="display: grid; grid-template-columns: 1fr 350px; gap: 30px; align-items: start;">
        
        <!-- Formulario de Checkout -->
        <div class="checkout-form" style="background: var(--bg-card); padding: 30px; border-radius: var(--radius-md); border: 1px solid var(--border-color);">
            <form action="{{ route('checkout.process') }}" method="POST" id="checkoutForm">
                @csrf
                
                <h3 style="margin-bottom: 20px; font-size: 1.3rem;">Datos de Contacto</h3>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 15px;">
                    <div>
                        <label style="display: block; margin-bottom: 5px; color: var(--text-muted);">Nombre</label>
                        <input type="text" name="nombre" value="{{ old('nombre', auth()->user()->nombre) }}" required class="form-input" style="width: 100%; padding: 10px; border-radius: var(--radius-sm); border: 1px solid var(--border-color); background: var(--bg-dark); color: var(--text-main);">
                        @error('nombre')<span style="color: var(--error-color); font-size: 0.85rem;">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 5px; color: var(--text-muted);">Apellido</label>
                        <input type="text" name="apellido" value="{{ old('apellido', auth()->user()->apellido) }}" required class="form-input" style="width: 100%; padding: 10px; border-radius: var(--radius-sm); border: 1px solid var(--border-color); background: var(--bg-dark); color: var(--text-main);">
                        @error('apellido')<span style="color: var(--error-color); font-size: 0.85rem;">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div style="margin-bottom: 30px;">
                    <label style="display: block; margin-bottom: 5px; color: var(--text-muted);">Teléfono (WhatsApp)</label>
                    <input type="text" name="telefono" value="{{ old('telefono', auth()->user()->telefono) }}" required class="form-input" style="width: 100%; padding: 10px; border-radius: var(--radius-sm); border: 1px solid var(--border-color); background: var(--bg-dark); color: var(--text-main);">
                    @error('telefono')<span style="color: var(--error-color); font-size: 0.85rem;">{{ $message }}</span>@enderror
                </div>

                <h3 style="margin-bottom: 20px; font-size: 1.3rem; border-top: 1px solid var(--border-color); padding-top: 20px;">Entrega</h3>
                <div style="margin-bottom: 20px;">
                    <label style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px; cursor: pointer;">
                        <input type="radio" name="tipo_entrega" value="local" checked onchange="toggleEnvio(this.value)">
                        Retirar por el Local (Hipólito Yrigoyen 2418, Corrientes)
                    </label>
                    <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                        <input type="radio" name="tipo_entrega" value="envio" onchange="toggleEnvio(this.value)">
                        Envío a Domicilio
                    </label>
                </div>

                <div id="datos_envio" style="display: none; background: var(--bg-dark); padding: 15px; border-radius: var(--radius-sm); margin-bottom: 30px;">
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; margin-bottom: 5px; color: var(--text-muted);">Dirección completa</label>
                        <input type="text" name="direccion" value="{{ old('direccion', auth()->user()->direccion) }}" class="form-input" style="width: 100%; padding: 10px; border-radius: var(--radius-sm); border: 1px solid var(--border-color); background: var(--bg-card); color: var(--text-main);">
                    </div>
                    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 15px;">
                        <div>
                            <label style="display: block; margin-bottom: 5px; color: var(--text-muted);">Ciudad / Localidad</label>
                            <input type="text" name="ciudad" value="{{ old('ciudad', auth()->user()->ciudad) }}" class="form-input" style="width: 100%; padding: 10px; border-radius: var(--radius-sm); border: 1px solid var(--border-color); background: var(--bg-card); color: var(--text-main);">
                        </div>
                        <div>
                            <label style="display: block; margin-bottom: 5px; color: var(--text-muted);">Código Postal</label>
                            <input type="text" name="codigo_postal" value="{{ old('codigo_postal', auth()->user()->codigo_postal) }}" class="form-input" style="width: 100%; padding: 10px; border-radius: var(--radius-sm); border: 1px solid var(--border-color); background: var(--bg-card); color: var(--text-main);">
                        </div>
                    </div>
                </div>

                <h3 style="margin-bottom: 20px; font-size: 1.3rem; border-top: 1px solid var(--border-color); padding-top: 20px;">Método de Pago</h3>
                <div style="margin-bottom: 30px;">
                    <label style="display: flex; align-items: center; gap: 10px; margin-bottom: 10px; cursor: pointer; background: var(--bg-dark); padding: 15px; border-radius: var(--radius-sm); border: 1px solid var(--border-color);">
                        <input type="radio" name="metodo_pago" value="transferencia" checked>
                        <div>
                            <strong>Transferencia Bancaria</strong>
                            <p style="font-size: 0.85rem; color: var(--text-muted); margin-top: 5px;">Te daremos el CBU al finalizar la compra.</p>
                        </div>
                    </label>
                    <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; background: var(--bg-dark); padding: 15px; border-radius: var(--radius-sm); border: 1px solid var(--border-color);">
                        <input type="radio" name="metodo_pago" value="tarjeta">
                        <div>
                            <strong>Tarjeta (Simulado)</strong>
                            <p style="font-size: 0.85rem; color: var(--text-muted); margin-top: 5px;">Pago mediante tarjeta de crédito/débito.</p>
                        </div>
                    </label>
                </div>

                <div style="margin-bottom: 20px;">
                    <label style="display: block; margin-bottom: 5px; color: var(--text-muted);">Notas (Opcional)</label>
                    <textarea name="notas" rows="3" class="form-input" style="width: 100%; padding: 10px; border-radius: var(--radius-sm); border: 1px solid var(--border-color); background: var(--bg-dark); color: var(--text-main); resize: vertical;"></textarea>
                </div>

                <button type="submit" class="btn-primary" style="width: 100%; padding: 15px; font-size: 1.1rem; text-align: center; border: none; cursor: pointer;">
                    Confirmar Compra
                </button>
            </form>
        </div>

        <!-- Resumen -->
        <div class="cart-summary" style="background: var(--bg-card); padding: 25px; border-radius: var(--radius-md); border: 1px solid var(--border-color); position: sticky; top: 100px;">
            <h2 style="font-size: 1.3rem; margin-bottom: 20px;">Resumen de tu Pedido</h2>
            
            <div style="display: flex; flex-direction: column; gap: 15px; margin-bottom: 20px;">
                @php $total = 0; @endphp
                @foreach($cart->items as $item)
                    @if($item->producto)
                        @php 
                            $subtotal = $item->producto->precio * $item->cantidad;
                            $total += $subtotal;
                        @endphp
                        <div style="display: flex; gap: 10px;">
                            <img src="{{ $item->producto->imagen_url }}" style="width: 50px; height: 50px; object-fit: cover; border-radius: var(--radius-sm);">
                            <div style="flex: 1;">
                                <div style="font-size: 0.95rem; font-weight: 500;">{{ $item->producto->nombre }}</div>
                                <div style="font-size: 0.85rem; color: var(--text-muted);">
                                    Cant: {{ $item->cantidad }}
                                    @if($item->talle) | Talle: {{ $item->talle->nombre }} @endif
                                </div>
                            </div>
                            <div style="font-weight: 500;">${{ number_format($subtotal, 0, ',', '.') }}</div>
                        </div>
                    @endif
                @endforeach
            </div>

            <div style="border-top: 1px solid var(--border-color); padding-top: 15px; margin-bottom: 15px; display: flex; justify-content: space-between; font-size: 1.1rem;">
                <span style="color: var(--text-muted);">Subtotal</span>
                <span>${{ number_format($total, 0, ',', '.') }}</span>
            </div>
            
            <div style="display: flex; justify-content: space-between; font-weight: 700; font-size: 1.4rem;">
                <span>Total</span>
                <span>${{ number_format($total, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleEnvio(tipo) {
        const datosEnvio = document.getElementById('datos_envio');
        const inputs = datosEnvio.querySelectorAll('input');
        
        if (tipo === 'envio') {
            datosEnvio.style.display = 'block';
            inputs.forEach(input => input.setAttribute('required', 'required'));
        } else {
            datosEnvio.style.display = 'none';
            inputs.forEach(input => input.removeAttribute('required'));
        }
    }
    
    // Ejecutar al cargar por si está seleccionado "envio" por validación fallida previa
    document.addEventListener('DOMContentLoaded', () => {
        const seleccionado = document.querySelector('input[name="tipo_entrega"]:checked');
        if (seleccionado) {
            toggleEnvio(seleccionado.value);
        }
    });
</script>
@endsection
