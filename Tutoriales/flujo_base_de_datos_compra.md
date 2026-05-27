# Flujo de Base de Datos: De la Selección a la Compra Final

Este documento explica detalladamente qué tablas de la base de datos interactúan y cómo se comunican entre sí desde que un cliente entra al catálogo hasta que completa exitosamente su compra.

---

## 1. El Catálogo: Mostrando los Productos
Cuando el cliente entra a la página web y ve los productos, el sistema consulta principalmente tres tablas:
- **`productos`**: De aquí extrae el nombre, precio, descripción e imagen.
- **`talles`**: La tabla maestra que tiene guardados los talles (S, M, L, XL).
- **`producto_talle` (Tabla Pivot)**: Esta tabla intermedia es **crucial**. Une a los productos con los talles y, lo más importante, **almacena el stock**. El sistema verifica aquí cuántas unidades quedan de cada talle para mostrar u ocultar la opción "Agotado".

## 2. Agregar al Carrito
Cuando el cliente elige un talle, una cantidad y presiona "Agregar al Carrito", el sistema no descuenta el stock aún, solo crea un registro temporal:
- **`carts`**: Primero busca si el usuario ya tiene un carrito abierto. Si no lo tiene, crea una fila en esta tabla asociándola al `usuario_id`.
- **`cart_items`**: Inmediatamente después, inserta una fila en esta tabla. Aquí guarda qué producto (`producto_id`), qué talle (`talle_id`) y cuántas unidades (`cantidad`) quiere el cliente, vinculándolo al `cart_id` del paso anterior.

## 3. La Pantalla de Checkout
El cliente va a "Finalizar Compra". El sistema vuelve a consultar la tabla **`cart_items`** para listar todo lo que está a punto de comprar y sumar los precios. Además, pregunta al cliente sus datos personales y método de pago, pero *aún no guarda nada de esto en la base de datos*.

## 4. Confirmar Compra (El Momento Clave)
Al presionar el botón "Confirmar Compra", ocurre la magia. Todo lo siguiente pasa en una fracción de segundo gracias a una **"Transacción de Base de Datos"** (si alguna de estas cosas falla, se cancela todo para evitar errores):

1. **Re-verificación de Stock:** El sistema viaja rápidamente a la tabla **`producto_talle`** para asegurar que, mientras el cliente estaba llenando el formulario, nadie más haya comprado su producto dejándolo sin stock.
2. **Creación de la Orden (`orders`)**: Se inserta una nueva fila en la tabla maestra de ventas. Se guarda el `usuario_id`, el `total` calculado, si eligió envío o local, su dirección, etc. Se le asigna por defecto el `estado = pendiente`. Al guardarse, la base de datos le genera un ID único (ej: `#00015`).
3. **Traspaso de Ítems (`order_items`)**: El sistema hace un "copie y pegue" inteligente. Recorre todo lo que había en la tabla temporal `cart_items` y lo inserta en esta nueva tabla definitiva. 
    - *Nota importante:* En `order_items` se guarda el `precio_unitario` del producto en **ese exacto momento**. Esto es para que si en 3 meses cambias el precio de la remera, el historial de esta orden mantenga el precio histórico y no se altere la contabilidad.
4. **Descuento de Stock (`producto_talle`)**: El sistema hace un UPDATE en esta tabla, restándole al stock actual la cantidad que el cliente acaba de comprar.
5. **Vaciar el Carrito (`cart_items`)**: Como la compra ya es oficial, el sistema elimina todas las filas asociadas a este cliente en la tabla del carrito.

## 5. La Pantalla de Éxito y Más Allá
Finalmente, el cliente es redirigido a la pantalla de éxito. Esa pantalla ya no consulta el carrito, sino que hace una consulta directa a tu tabla **`orders`** y sus **`order_items`** para mostrarle el comprobante final.

Si más adelante el administrador entra a su panel y decide cambiar el estado de la orden a "Cancelado", el sistema hará el paso inverso: actualizará la fila en **`orders`** y viajará de nuevo a **`producto_talle`** para sumar y devolver ese stock perdido, dejándolo disponible otra vez en el catálogo.
