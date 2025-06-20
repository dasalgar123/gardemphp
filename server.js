const express = require('express');
const mysql = require('mysql2');
const cors = require('cors');
require('dotenv').config();

const app = express();
const PORT = process.env.PORT || 5000;

// Middleware
app.use(cors());
app.use(express.json());

// Configuración de la base de datos
const db = mysql.createConnection({
  host: process.env.DB_HOST || 'localhost',
  user: process.env.DB_USER || 'root',
  password: process.env.DB_PASSWORD || '',
  database: process.env.DB_NAME || 'gardelcatalogo'
});

// Conectar a la base de datos
db.connect((err) => {
  if (err) {
    console.error('Error conectando a la base de datos:', err);
    console.error('Verifica que:');
    console.error('1. MySQL esté corriendo');
    console.error('2. Las credenciales sean correctas');
    console.error('3. La base de datos "gardelcatalogo" exista');
    return;
  }
  console.log('✅ Conectado a la base de datos MySQL gardelcatalogo');
});

// Ruta de prueba
app.get('/api/test', (req, res) => {
  res.json({ message: 'Servidor funcionando correctamente' });
});

// Rutas API

// Obtener todos los productos
app.get('/api/productos', (req, res) => {
  const query = `
    SELECT p.*, c.nombre as categoria_nombre 
    FROM productos p 
    LEFT JOIN categorias c ON p.categoria_id = c.id
  `;
  
  db.query(query, (err, results) => {
    if (err) {
      console.error('Error al obtener productos:', err);
      res.status(500).json({ error: 'Error interno del servidor' });
      return;
    }
    console.log(`✅ Productos obtenidos: ${results.length} productos`);
    res.json(results);
  });
});

// Obtener categorías
app.get('/api/categorias', (req, res) => {
  const query = 'SELECT * FROM categorias';
  
  db.query(query, (err, results) => {
    if (err) {
      console.error('Error al obtener categorías:', err);
      res.status(500).json({ error: 'Error interno del servidor' });
      return;
    }
    console.log(`✅ Categorías obtenidas: ${results.length} categorías`);
    res.json(results);
  });
});

// Obtener colores
app.get('/api/colores', (req, res) => {
  const query = 'SELECT * FROM colores';
  
  db.query(query, (err, results) => {
    if (err) {
      console.error('Error al obtener colores:', err);
      res.status(500).json({ error: 'Error interno del servidor' });
      return;
    }
    res.json(results);
  });
});

// Obtener tallas
app.get('/api/tallas', (req, res) => {
  const query = 'SELECT * FROM tallas';
  
  db.query(query, (err, results) => {
    if (err) {
      console.error('Error al obtener tallas:', err);
      res.status(500).json({ error: 'Error interno del servidor' });
      return;
    }
    res.json(results);
  });
});

// Obtener inventario por producto
app.get('/api/inventario/:productoId', (req, res) => {
  const productoId = req.params.productoId;
  const query = `
    SELECT itcc.*, c.nombre as color_nombre, t.nombre as talla_nombre, cat.nombre as categoria_nombre
    FROM inventario_tallas_colores_categorias itcc
    LEFT JOIN colores c ON itcc.color_id = c.id
    LEFT JOIN tallas t ON itcc.talla_id = t.id
    LEFT JOIN categorias cat ON itcc.categoria_id = cat.id
    WHERE itcc.producto_id = ?
  `;
  
  db.query(query, [productoId], (err, results) => {
    if (err) {
      console.error('Error al obtener inventario:', err);
      res.status(500).json({ error: 'Error interno del servidor' });
      return;
    }
    res.json(results);
  });
});

// Crear un nuevo pedido
app.post('/api/pedidos', (req, res) => {
  const { cliente_nombre, cliente_email, cliente_telefono, total, items } = req.body;
  
  const pedidoQuery = `
    INSERT INTO pedidos (cliente_nombre, cliente_email, cliente_telefono, total, fecha_pedido, estado)
    VALUES (?, ?, ?, ?, NOW(), 'pendiente')
  `;
  
  db.query(pedidoQuery, [cliente_nombre, cliente_email, cliente_telefono, total], (err, result) => {
    if (err) {
      console.error('Error al crear pedido:', err);
      res.status(500).json({ error: 'Error interno del servidor' });
      return;
    }
    
    const pedidoId = result.insertId;
    
    // Insertar detalles del pedido
    const detallesQuery = `
      INSERT INTO detalle_pedidos (pedido_id, producto_id, talla_id, color_id, cantidad, precio_unitario)
      VALUES (?, ?, ?, ?, ?, ?)
    `;
    
    const detallesPromises = items.map(item => {
      return new Promise((resolve, reject) => {
        db.query(detallesQuery, [
          pedidoId, 
          item.producto_id, 
          item.talla_id, 
          item.color_id, 
          item.cantidad, 
          item.precio_unitario
        ], (err, result) => {
          if (err) reject(err);
          else resolve(result);
        });
      });
    });
    
    Promise.all(detallesPromises)
      .then(() => {
        res.json({ 
          success: true, 
          pedido_id: pedidoId,
          message: 'Pedido creado exitosamente' 
        });
      })
      .catch(err => {
        console.error('Error al crear detalles del pedido:', err);
        res.status(500).json({ error: 'Error interno del servidor' });
      });
  });
});

// Iniciar servidor
app.listen(PORT, () => {
  console.log(`🚀 Servidor corriendo en puerto ${PORT}`);
  console.log(`📡 API disponible en: http://localhost:${PORT}/api`);
  console.log(`🧪 Ruta de prueba: http://localhost:${PORT}/api/test`);
}); 