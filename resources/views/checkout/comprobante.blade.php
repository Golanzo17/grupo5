<!DOCTYPE html>
<html lang="es-AR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprobante de Compra #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</title>
    <!-- Google Fonts para darle un toque limpio y moderno -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Bebas+Neue&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --text-main: #111827;
            --text-muted: #6b7280;
            --border-color: #e5e7eb;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--text-main);
            background: #f3f4f6;
            margin: 0;
            padding: 40px 20px;
        }

        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            background: #ffffff;
            padding: 50px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 2px solid var(--text-main);
            padding-bottom: 20px;
            margin-bottom: 40px;
        }

        .logo-text {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 3rem;
            letter-spacing: 2px;
            margin: 0;
            line-height: 1;
        }

        .invoice-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0 0 5px 0;
            text-transform: uppercase;
            text-align: right;
        }

        .invoice-number {
            font-size: 1.1rem;
            color: var(--text-muted);
            margin: 0;
            text-align: right;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-bottom: 40px;
        }

        .info-section h3 {
            font-size: 0.9rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 0 0 10px 0;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 5px;
        }

        .info-section p {
            margin: 0 0 5px 0;
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }

        .invoice-table th {
            background: #f9fafb;
            padding: 12px 15px;
            text-align: left;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-muted);
            border-bottom: 2px solid var(--border-color);
        }

        .invoice-table td {
            padding: 15px;
            border-bottom: 1px solid var(--border-color);
            font-size: 0.95rem;
        }

        .invoice-table th.right, .invoice-table td.right {
            text-align: right;
        }

        .totals {
            width: 50%;
            margin-left: auto;
        }

        .totals-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            font-size: 1rem;
        }

        .totals-row.grand-total {
            font-size: 1.4rem;
            font-weight: 700;
            border-top: 2px solid var(--text-main);
            padding-top: 15px;
            margin-top: 5px;
        }

        .footer {
            margin-top: 60px;
            text-align: center;
            font-size: 0.85rem;
            color: var(--text-muted);
            border-top: 1px solid var(--border-color);
            padding-top: 20px;
        }

        .btn-print {
            display: block;
            width: 200px;
            margin: 0 auto 30px auto;
            padding: 12px 20px;
            background: var(--text-main);
            color: #ffffff;
            text-align: center;
            text-decoration: none;
            font-weight: 600;
            border-radius: 6px;
            cursor: pointer;
            border: none;
            font-size: 1rem;
            font-family: 'Inter', sans-serif;
        }

        .btn-print:hover {
            background: #374151;
        }

        /* Ocultar elementos en impresión */
        @media print {
            body {
                background: white;
                padding: 0;
            }
            .invoice-container {
                box-shadow: none;
                padding: 0;
            }
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body>

    <button onclick="window.print()" class="btn-print no-print">🖨️ Imprimir Comprobante</button>

    <div class="invoice-container">
        
        <div class="invoice-header">
            <div>
                <h1 class="logo-text">WESTSIDE</h1>
                <p style="margin: 10px 0 0 0; color: var(--text-muted); font-size: 0.9rem;">
                    Hipólito Yrigoyen 2418, Corrientes<br>
                    IG: @westside.corrientes
                </p>
            </div>
            <div>
                <h2 class="invoice-title">Comprobante</h2>
                <p class="invoice-number">Orden #{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</p>
                <p class="invoice-number" style="font-size: 0.9rem;">Fecha: {{ $order->created_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        <div class="info-grid">
            <div class="info-section">
                <h3>Facturar A</h3>
                <p><strong>{{ $order->nombre }} {{ $order->apellido }}</strong></p>
                <p>Teléfono: {{ $order->telefono }}</p>
                <p>Estado de pago: <strong>{{ ucfirst($order->estado) }}</strong></p>
                <p>Método de pago: {{ ucfirst($order->metodo_pago) }}</p>
            </div>
            
            <div class="info-section">
                <h3>Detalles de Entrega</h3>
                @if($order->tipo_entrega === 'local')
                    <p><strong>Retiro en Local</strong></p>
                    <p>Hipólito Yrigoyen 2418, Corrientes</p>
                @else
                    <p><strong>Envío a Domicilio</strong></p>
                    <p>{{ $order->direccion }}</p>
                    <p>{{ $order->ciudad }} (CP: {{ $order->codigo_postal }})</p>
                @endif
                @if($order->notas)
                    <p style="margin-top: 10px;"><em>Notas: {{ $order->notas }}</em></p>
                @endif
            </div>
        </div>

        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Descripción</th>
                    <th class="right">Cant.</th>
                    <th class="right">Precio Unit.</th>
                    <th class="right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td>
                            @if($item->producto)
                                <strong>{{ $item->producto->nombre }}</strong>
                                @if($item->talle) <br><span style="color: var(--text-muted); font-size: 0.85rem;">Talle: {{ $item->talle->nombre }}</span> @endif
                            @else
                                <strong>Producto Eliminado</strong>
                            @endif
                        </td>
                        <td class="right">{{ $item->cantidad }}</td>
                        <td class="right">${{ number_format($item->precio_unitario, 0, ',', '.') }}</td>
                        <td class="right">${{ number_format($item->precio_unitario * $item->cantidad, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="totals">
            <div class="totals-row">
                <span>Subtotal</span>
                <span>${{ number_format($order->total, 0, ',', '.') }}</span>
            </div>
            <div class="totals-row grand-total">
                <span>Total</span>
                <span>${{ number_format($order->total, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="footer">
            <p><strong>¡Gracias por tu compra en WESTSIDE!</strong></p>
            <p>Recordá que los cambios se realizan únicamente dentro de los 15 días con la prenda sin uso y su etiqueta original.</p>
        </div>

    </div>

</body>
</html>
