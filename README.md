# ✂️👕 Westside - Ropa & Barbería

Bienvenido al repositorio oficial del sitio web de **Westside**, un espacio digital diseñado para unificar nuestra marca de ropa de estilo propio y nuestros servicios de barbería en un solo lugar. 

Este proyecto busca ofrecer a los clientes una experiencia fluida para explorar nuestro catálogo de prendas y conocer nuestros servicios de estética masculina.

## 🚀 Características Principales (Features)

* **Catálogo de Ropa:** Galería interactiva mostrando las últimas colecciones y prendas de la marca.
* **Sección de Barbería:** Información sobre cortes, estilos y servicios que ofrecemos.
* **Diseño Responsivo:** Interfaz adaptada para verse perfectamente tanto en dispositivos móviles como en computadoras de escritorio.
* **Contacto y Ubicación:** Integración con mapas y enlaces directos a nuestras redes sociales.

---

## 🛠️ Tecnologías Utilizadas

Este proyecto fue desarrollado utilizando las siguientes tecnologías:

* **HTML5:** Estructura semántica del sitio.
* **[JavaScript / Otro framework]:** [Para interactividad, menús móviles o carruseles de imágenes].
* **PHP:** Lenguaje de programación principal para la lógica del servidor.
* **Blade:** Motor de plantillas utilizado para crear las vistas dinámicas y modulares de la web.
* **CSS3:** Estilos personalizados para definir la identidad visual urbana y moderna de la marca.
---


## 🎨 Estilo y Diseño

El diseño de la web refleja la identidad de Westside: un enfoque moderno y urbano. Nos aseguramos de mantener una paleta de colores coherente y de optimizar las imágenes (como las texturas de la ropa y las fotos de la barbería) para que la página cargue rápido sin perder calidad visual.

---

## ⚙️ Instrucciones de Instalación y Pruebas (Evaluadores)

Para probar la aplicación localmente, sigue estos pasos:

1. Clona este repositorio en tu equipo.
2. Instala las dependencias (requiere PHP y Composer):
   ```bash
   composer install
   npm install
   ```
3. Crea tu archivo de entorno copiando el de ejemplo:
   - En Windows: `copy .env.example .env`
   - En Mac/Linux: `cp .env.example .env`
4. Genera la clave de la aplicación:
   ```bash
   php artisan key:generate
   ```

### 🗄️ Carga de la Base de Datos (SQLite)
Puedes elegir UNA de las siguientes opciones para cargar los datos (productos, talles, administradores, etc.):

**Opción A (Recomendada): Migraciones y Seeders**
Ejecuta el siguiente comando en la terminal para crear las tablas y llenarlas automáticamente con nuestros datos de prueba programados:
```bash
php artisan migrate:fresh --seed
```

**Opción B: Usar la copia de seguridad pre-cargada**
Si prefieres no usar comandos de migración, navega a la carpeta `database/`, busca el archivo llamado `database.sqlite.example` y **renómbralo** a `database.sqlite`.
*(⚠️ Nota importante: Si usas esta opción, por favor NO ejecutes los seeders para evitar conflictos y datos duplicados).*

5. Finalmente, levanta el servidor local para ver la web:
   ```bash
   php artisan serve
   ```

---

## 📞 Contacto y Redes

Si tienes alguna pregunta, sugerencia o simplemente quieres ver nuestro trabajo, puedes encontrarnos aquí:

* **Ubicación:** Corrientes, Argentina.
* **Instagram (Ropa):** [@westsid3club](https://www.instagram.com/westsid3club/)
* **Instagram (Barbería):** [@westsidebarberclub](https://www.instagram.com/westsidebarberclub/)
* 

---

**Westside © 2026** 