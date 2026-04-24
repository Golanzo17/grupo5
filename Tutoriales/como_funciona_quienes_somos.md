# Cómo funciona la página "Quiénes Somos" (Scrollytelling)

La página `quienes-somos.blade.php` utiliza un efecto moderno de diseño web conocido como **Scrollytelling** (relatar una historia al hacer scroll). A medida que el usuario lee el texto bajando por la página, las imágenes de la derecha cambian dinámicamente para acompañar la historia.

Todo el código está contenido en un solo archivo e incluye tres partes clave: **Estructura HTML**, **Estilos CSS** y **Lógica en JavaScript**. A continuación, explicamos cada una.

---

## 1. Estructura HTML (Layout de dos columnas)

El contenedor principal (`.story-container`) se divide usando `flexbox` en dos mitades (50% y 50% de ancho):

*   **Columna Izquierda (`.story-text-column`)**: Contiene los párrafos del texto. Cada párrafo está envuelto en un contenedor `<div class="story-step" data-step="X">`. Tienen una altura mínima muy grande (`min-height: 80vh`), lo que fuerza al usuario a hacer mucho *scroll* (bajar) para pasar de un texto a otro, dándole tiempo para leer y para que la imagen de la derecha tenga presencia.
*   **Columna Derecha (`.story-visual-column`)**: Contiene un envoltorio llamado `.visual-wrapper` que tiene las imágenes o los "placeholders" (`.story-image`). A cada imagen se le asignó un `id` que coincide con el número del párrafo (por ejemplo, `id="story-img-1"` se activará cuando se lea el párrafo con `data-step="1"`).

---

## 2. Los Trucos en CSS (El efecto Sticky)

La "magia" visual ocurre en los estilos CSS:

*   **El texto (Opacity y Transform):** Por defecto, los párrafos están con opacidad baja (`0.2`) y un poco desplazados hacia abajo (`translateY(30px)`). Cuando reciben la clase `.is-active`, suben a su posición normal y la opacidad sube a `1` (se iluminan).
*   **Las imágenes pegadas (Sticky):** El `.visual-wrapper` usa `position: sticky; top: calc(var(--nav-height) + 10vh);`. Esto significa que cuando el usuario hace scroll hacia abajo, esta caja **se queda pegada a la pantalla** y no sube junto con el resto de la página. Las imágenes se quedan quietas a la vista del usuario mientras el texto de la izquierda sigue subiendo.
*   **Transiciones de Imágenes:** Las imágenes usan `position: absolute;` para apilarse unas encima de otras. Por defecto tienen opacidad 0. Cuando reciben la clase `.active`, su opacidad pasa a 1 suavemente y se escalan un poco (de `0.95` a `1`).
*   **Fondo y Marca de agua:** Se le agregó al `<body>` la clase `.catalog-bg` para traer el fondo punteado. Para que se vea, la `.storytelling-section` tiene un fondo `transparent`.

---

## 3. Lógica JavaScript (Intersection Observer)

En la parte inferior de la página hay un pequeño bloque de JavaScript (`<script>`) que hace que todo se conecte.

En lugar de instalar librerías pesadas, se usó una herramienta nativa de los navegadores modernos llamada **`IntersectionObserver`**. Sirve para saber cuándo un elemento "cruza" una parte de la pantalla.

### ¿Qué hace el script paso a paso?

1.  Busca todos los párrafos (`.story-step`) y todas las imágenes (`.story-image`).
2.  Configura el Observador con un `rootMargin: '-40% 0px -40% 0px'`. Esto crea una "línea invisible" en el centro de tu pantalla (ignorando el 40% de arriba y el 40% de abajo).
3.  Le dice al Observador que mire todos los párrafos.
4.  Cuando un párrafo cruza ese centro de la pantalla, el script:
    *   Mira qué número de paso es (`data-step="X"`).
    *   **Apaga** (le quita la clase `is-active`) a todos los textos, y se la **enciende** solo al que acaba de cruzar el centro.
    *   **Apaga** todas las imágenes, y busca la que tenga el ID igual al párrafo (`story-img-X`) y se la **enciende** (le agrega la clase `active`).

Es un sistema muy eficiente, ligero y fácil de modificar. Si algún día quieres agregar un quinto párrafo, solo agregas otro `<div class="story-step" data-step="5">` y otra imagen `<div id="story-img-5">`, y el script la detectará y hará funcionar automáticamente.
