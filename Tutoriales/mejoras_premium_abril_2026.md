# Mejoras Premium de Diseño — Sesión Abril 2026

En esta sesión realizamos un refactor visual completo del sitio para elevarlo a un nivel de diseño más profesional y premium. A continuación se explica cada cambio realizado, qué archivo se modificó y por qué se hizo así.

---

## 1. Nueva Tipografía: Bebas Neue

**Archivo modificado:** `resources/views/partes/head.blade.php`

Reemplazamos la fuente `Impact` por **Bebas Neue**, que es la tipografía display más usada en marcas de streetwear y moda urbana (la usan marcas como Supreme, Palace, Off-White).

```html
<!-- Antes -->
<link href="https://fonts.googleapis.com/css2?family=Impact&display=swap">

<!-- Ahora -->
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap">
```

En `app.css` la variable quedó así:
```css
--font-impact: 'Bebas Neue', 'Impact', sans-serif;
```

El segundo valor `Impact` es un **fallback**: si por alguna razón Bebas Neue no carga, el navegador usa Impact. Así nunca se rompe el diseño.

---

## 2. Sistema de Diseño Mejorado (app.css)

**Archivo modificado:** `resources/css/app.css`

Agregamos variables CSS nuevas que actúan como "tokens de diseño" — valores que se reutilizan en todo el sitio:

```css
--border-color: #2a2a2a;   /* Borde más oscuro y sutil */
--radius-sm: 8px;          /* Bordes redondeados pequeños */
--radius-md: 12px;         /* Bordes redondeados medianos */
--radius-lg: 20px;         /* Bordes redondeados grandes */
--shadow-card: 0 8px 32px rgba(0,0,0,0.45);   /* Sombra de card */
--shadow-hover: 0 20px 60px rgba(0,0,0,0.6);  /* Sombra al pasar el mouse */
```

Usando variables, si algún día querés cambiar el tamaño del borde redondeado de todas las cards del sitio, solo modificás `--radius-lg` en un lugar y se actualiza en todos lados automáticamente.

### Botón ghost (transparente)

Agregamos una nueva clase de botón para cuando necesitás un CTA secundario que no compita visualmente con el principal:

```css
.btn-ghost {
    background-color: transparent;
    border: 1px solid rgba(255,255,255,0.3);
    color: var(--text-main);
}
```

La regla de diseño es: **botón sólido = acción principal, botón ghost = acción secundaria**.

---

## 3. Página Principal — Mejoras de contenido

**Archivo modificado:** `resources/views/Principal.blade.php`

### Hero con dos botones diferenciados

```html
<a href="#catalogo" class="btn-primary btn-large">Ver Colección</a>
<a href="/turnos"   class="btn-ghost   btn-large">Sacar Turno</a>
```

### Scroll Indicator animado

Agregamos una pequeña flecha con texto "Scroll" que aparece en la parte inferior del hero y se mueve suavemente para invitar al usuario a bajar. Se hace con una animación CSS llamada `scrollFade`:

```css
@keyframes scrollFade {
    0%, 100% { opacity: 0.4; transform: translateX(-50%) translateY(0); }
    50%       { opacity: 1;   transform: translateX(-50%) translateY(6px); }
}
```

### Sección de Estadísticas (Stats)

Agregamos una franja con 4 números clave del negocio entre la sección "Quiénes Somos" y el catálogo. Esto genera credibilidad de manera instantánea.

```html
<div class="stat-item">
    <span class="stat-number">+625</span>
    <span class="stat-label">Clientes atendidos</span>
</div>
```

### Badges de sección

Antes de cada título de sección agregamos una pequeña etiqueta descriptiva:

```html
<span class="section-badge">Nuestra historia</span>
<h2>Cultura & Estilo</h2>
```

Esto le da contexto al usuario antes de leer el título principal, como hacen las webs de Apple o Nike.

### Step Cards rediseñadas

Los números `1` y `2` en círculos blancos fueron reemplazados por íconos SVG dentro de cajas con borde. El SVG es una imagen vectorial que no pierde calidad en ningún tamaño de pantalla.

---

## 4. Página de Turnos — Nueva página completa

**Archivos creados:**
- `resources/views/Turnos.blade.php` — estructura principal
- `resources/views/partes/turnos-servicios.blade.php` — cards de servicios
- `resources/views/partes/turnos-opciones.blade.php` — opciones de turno
- `resources/views/partes/turnos-formulario.blade.php` — formulario WhatsApp

La página se dividió en tres partials (partes reutilizables) siguiendo el mismo patrón que ya usabas en el proyecto (como `ig-cards.blade.php`). Esto mantiene el código ordenado: cada partial tiene su propio HTML + CSS.

### El formulario generador de WhatsApp

El formulario no envía datos a ningún servidor. Cuando el usuario hace clic en "Pedir Turno", JavaScript arma el mensaje y abre WhatsApp directamente:

```javascript
let msg = `Hola! Soy *${nombre}* y quiero sacar un turno en West Side Barber.`;
msg += `\n✂️ *Servicio:* ${servicio}`;
window.open(`https://wa.me/${WSP_NUMBER}?text=${encodeURIComponent(msg)}`, '_blank');
```

El `encodeURIComponent()` convierte el texto al formato que acepta una URL (los espacios se vuelven `%20`, etc.).

---

## 5. Catálogo — Rediseño completo

**Archivos modificados:**
- `resources/views/Catalogo.blade.php` — rediseño completo
- `resources/views/partes/productos_estaticos.blade.php` — cards actualizadas

### Header premium

El encabezado pasó de ser solo un `<h2>Catálogo</h2>` a tener:
- Badge de sección
- Título grande con Bebas Neue
- Buscador con ícono de lupa integrado
- Contador de productos en tiempo real
- Filtros por categoría

### Filtros por categoría (chips)

Cada producto tiene un atributo `data-category` que JavaScript usa para filtrar:

```html
<div class="product-card" data-category="remeras">
```

```javascript
const category = card.getAttribute('data-category');
const matchFilter = activeFilter === 'all' || category === activeFilter;
```

### Overlay de WhatsApp en cada card

Al pasar el mouse sobre una card aparece un overlay oscuro con un botón verde de WhatsApp. El mensaje ya incluye el nombre del producto:

```javascript
document.querySelectorAll('.product-overlay-btn').forEach(btn => {
    const name = btn.closest('.product-card').querySelector('h4').innerText;
    btn.href = `https://wa.me/${WSP_NUMBER}?text=${encodeURIComponent('Me interesa: ' + name)}`;
});
```

### Animación de entrada con IntersectionObserver

Las cards no aparecen de golpe. Usan una API del navegador llamada `IntersectionObserver` que detecta cuándo un elemento entra al área visible de la pantalla:

```javascript
const cardObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('card-visible'); // Activa la animación
            cardObserver.unobserve(entry.target);       // Deja de observar (eficiencia)
        }
    });
}, { threshold: 0 }); // threshold: 0 = dispara apenas entra 1 píxel
```

Cuando la card entra al viewport, se le agrega la clase `card-visible` que activa la transición CSS de `opacity: 0 → 1` y `translateY(18px) → 0`.

---

## 6. Solución al conflicto del partial compartido

**Archivo modificado:** `resources/views/Principal.blade.php`

El archivo `productos_estaticos.blade.php` se usa en dos lugares: el carrusel de Principal y la grilla del Catálogo. Los overlays y badges son elementos que solo tienen sentido en el catálogo, pero el HTML se renderiza en ambas páginas.

La solución fue ocultar esos elementos en el carrusel usando CSS con un selector específico:

```css
#product-carousel .product-overlay,
#product-carousel .product-cat-tag,
#product-carousel .product-new-tag {
    display: none !important;
}
```

El `!important` asegura que esta regla gane sobre cualquier otro estilo que pudiera existir. Solo afecta a los elementos dentro de `#product-carousel`, sin tocar el catálogo.

---

## 7. Regla para compilar los cambios de CSS

Cada vez que modificás `app.css` (o cualquier archivo de `resources/`), necesitás tener corriendo el servidor de Vite para que los cambios se vean en el navegador:

```bash
cmd /c "npm run dev"
```

Este comando compila y sirve los assets (CSS y JS). Si lo cerrás, los cambios en el CSS dejan de verse hasta que lo volvés a correr.

---

*Tutorial generado automáticamente — Sesión de trabajo: Abril 2026*
