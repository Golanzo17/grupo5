# Sistema de Consultas - Documentación

## 📋 Descripción

Se ha implementado un sistema funcional de consultas que permite a los clientes:
- Enviar consultas desde el formulario en la página `/consultas`
- Las consultas se guardan en la base de datos
- El administrador puede ver todas las consultas en el panel de admin

## 🔧 Componentes Implementados

### 1. **Modelo: `Consulta`**
- Ubicación: `app/Models/Consulta.php`
- Campos:
  - `id` - ID único
  - `nombre` - Nombre del cliente
  - `email` - Email del cliente
  - `mensaje` - Mensaje de la consulta
  - `leida` - Booleano para marcar si fue leída
  - `created_at`, `updated_at` - Timestamps automáticos

### 2. **Migración: `create_consultas_table`**
- Ubicación: `database/migrations/2026_06_03_000000_create_consultas_table.php`
- Crea la tabla `consultas` con los campos necesarios

### 3. **Controlador: `ConsultaController`**
- Ubicación: `app/Http/Controllers/ConsultaController.php`
- Métodos:
  - `store()` - Guarda nuevas consultas (ruta: POST `/consultas`)
  - `index()` - Muestra todas las consultas (solo admin)
  - `marcarLeida()` - Marca una consulta como leída
  - `destroy()` - Elimina una consulta

### 4. **Formulario Actualizado**
- Ubicación: `resources/views/partes/formulario_contacto.blade.php`
- Ahora envía datos reales a la API con AJAX
- Valida campos en servidor
- Muestra mensajes de éxito/error

### 5. **Vista Admin: Gestión de Consultas**
- Ubicación: `resources/views/admin/consultas/index.blade.php`
- Características:
  - Tabla con todas las consultas
  - Estado "Nueva" o "Leída" con colores diferenciados
  - Botón para ver detalles completos
  - Modal para ver el mensaje completo
  - Opción de marcar como leída
  - Opción de eliminar
  - Paginación

### 6. **Dashboard Admin Actualizado**
- Ubicación: `resources/views/Backend/Admin/Dashboard.blade.php`
- Agrega:
  - Tarjeta con contador de consultas (con badge de consultas nuevas)
  - Sección que muestra las últimas 5 consultas sin leer
  - Enlace rápido a la página de gestión de consultas

### 7. **Menú Sidebar Admin**
- Ubicación: `resources/views/layouts/admin.blade.php`
- Agrega enlace a "Consultas" en el menú lateral

### 8. **Rutas**
- Ubicación: `routes/web.php`
- Rutas públicas:
  - `POST /consultas` - Guardar nueva consulta
- Rutas admin:
  - `GET /admin/consultas` - Ver todas las consultas
  - `PATCH /admin/consultas/{consulta}/leida` - Marcar como leída
  - `DELETE /admin/consultas/{consulta}` - Eliminar consulta

## 🚀 Uso

### Para los clientes:
1. Ir a `/consultas`
2. Completar el formulario (nombre, email, mensaje)
3. Hacer clic en "Enviar Consulta"
4. Ver mensaje de confirmación

### Para el administrador:
1. Ingresar a panel admin (`/admin`)
2. Ver tarjeta de "Consultas" con total y cantidad de nuevas
3. Hacer clic en "Consultas" en el menú o en la tarjeta
4. Ver tabla con todas las consultas
5. Hacer clic en "Ver" para ver el mensaje completo
6. Marcar como leída con el botón correspondiente
7. Eliminar si es necesario

## 🗄️ Migraciones

Para aplicar los cambios a la base de datos, ejecuta:

```bash
php artisan migrate
```

## ✅ Validaciones

El formulario valida:
- Nombre: requerido, máximo 255 caracteres
- Email: requerido, email válido, máximo 255 caracteres
- Mensaje: requerido, máximo 1000 caracteres

## 🎨 Estilos

- El formulario mantiene los estilos existentes del proyecto
- Vista admin usa Tailwind CSS
- Responsive design en todas las vistas
- Colores coherentes con la identidad visual

## 📱 Responsive

Todas las vistas son completamente responsive y funcionan en:
- Desktop
- Tablet
- Mobile

---

**Implementado el:** 3 de junio de 2026
