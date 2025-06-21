# Catálogo Gardem - React + MySQL

Un catálogo de productos desarrollado con React.js y conectado a una base de datos MySQL.

## 🚀 Características

- **Frontend**: React.js con componentes modulares
- **Backend**: Node.js + Express
- **Base de Datos**: MySQL
- **Funcionalidades**:
  - Catálogo de productos dinámico
  - Filtrado por categorías
  - Ordenamiento por precio
  - Carrito de compras
  - Selección de colores y tallas
  - Sistema de pedidos

## 📋 Requisitos Previos

- Node.js (versión 14 o superior)
- MySQL Server
- npm o yarn

## 🛠️ Instalación

1. **Clonar el repositorio**
   ```bash
   git clone <url-del-repositorio>
   cd catalogoRopa
   ```

2. **Instalar dependencias**
   ```bash
   npm install
   ```

3. **Configurar la base de datos**
   - Asegúrate de que MySQL esté corriendo
   - Crea una base de datos llamada `gardelcatalogo`
   - Importa las tablas necesarias (categorias, colores, productos, tallas, etc.)

4. **Configurar variables de entorno**
   - Crea un archivo `.env` en la raíz del proyecto
   - Configura las credenciales de tu base de datos:
   ```
   DB_HOST=localhost
   DB_USER=tu_usuario
   DB_PASSWORD=tu_contraseña
   DB_NAME=gardelcatalogo
   PORT=5000
   ```

## 🚀 Ejecución

### Opción 1: Ejecutar todo junto (Recomendado)
```bash
npm run dev
```
Esto ejecutará tanto el servidor backend (puerto 5000) como el frontend (puerto 3001).

### Opción 2: Ejecutar por separado

**Backend:**
```bash
npm run server
```

**Frontend (en otra terminal):**
```bash
npm start
```

## 📊 Estructura de la Base de Datos

### Tablas Principales:
- **categorias**: Categorías de productos
- **colores**: Colores disponibles
- **productos**: Información de productos
- **tallas**: Tallas disponibles
- **inventario_tallas_colores_categorias**: Relación de inventario
- **pedidos**: Pedidos de clientes
- **detalle_pedidos**: Detalles de pedidos
- **mensajes_pedidos**: Mensajes relacionados

## 🔧 Configuración del Backend

El servidor backend (`server.js`) incluye las siguientes rutas API:

- `GET /api/productos` - Obtener todos los productos
- `GET /api/categorias` - Obtener categorías
- `GET /api/colores` - Obtener colores
- `GET /api/tallas` - Obtener tallas
- `GET /api/inventario/:productoId` - Obtener inventario por producto
- `POST /api/pedidos` - Crear nuevo pedido

## 📁 Estructura del Proyecto

```
catalogoRopa/
├── src/
│   ├── componentes/
│   │   ├── elementos/     # Componentes reutilizables
│   │   ├── vistas/        # Vistas principales
│   │   └── css/          # Estilos CSS
│   ├── services/
│   │   └── api.js        # Servicios para conectar con el backend
│   └── App.js            # Componente principal
├── server.js             # Servidor backend
├── package.json
└── README.md
```

## 🎨 Personalización

### Cambiar el título
Edita el archivo `src/componentes/vistas/VistaACatalogo.js` y modifica la línea:
```javascript
<ElementoTitulo texto="Gardem" />
```

### Modificar estilos
Los estilos están organizados en archivos CSS separados en `src/componentes/css/`.

## 🔍 Solución de Problemas

### Error de conexión a la base de datos
1. Verifica que MySQL esté corriendo
2. Confirma las credenciales en el archivo `server.js`
3. Asegúrate de que la base de datos `gardelcatalogo` exista

### Error de CORS
El servidor ya incluye configuración CORS. Si persisten problemas, verifica que el frontend esté corriendo en el puerto correcto.

### Productos no se cargan
1. Verifica que el servidor backend esté corriendo en el puerto 5000
2. Revisa la consola del navegador para errores
3. Confirma que las tablas de la base de datos tengan datos

## 📝 Notas

- El frontend corre en `http://localhost:3001`
- El backend corre en `http://localhost:5000`
- Los datos se cargan dinámicamente desde la base de datos MySQL
- El carrito de compras funciona en memoria (se reinicia al recargar la página)

## 🤝 Contribución

1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📄 Licencia

Este proyecto está bajo la Licencia MIT. Ver el archivo `LICENSE` para más detalles.
