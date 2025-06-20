const API_BASE_URL = 'http://localhost:5000/api';

// Función para hacer peticiones HTTP
const fetchAPI = async (endpoint, options = {}) => {
  try {
    const response = await fetch(`${API_BASE_URL}${endpoint}`, {
      headers: {
        'Content-Type': 'application/json',
        ...options.headers,
      },
      ...options,
    });

    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`);
    }

    return await response.json();
  } catch (error) {
    console.error('Error en fetchAPI:', error);
    throw error;
  }
};

// Servicios para productos
export const productosAPI = {
  // Obtener todos los productos
  getAll: () => fetchAPI('/productos'),
  
  // Obtener producto por ID
  getById: (id) => fetchAPI(`/productos/${id}`),
  
  // Obtener inventario de un producto
  getInventario: (productoId) => fetchAPI(`/inventario/${productoId}`),
};

// Servicios para categorías
export const categoriasAPI = {
  getAll: () => fetchAPI('/categorias'),
};

// Servicios para colores
export const coloresAPI = {
  getAll: () => fetchAPI('/colores'),
};

// Servicios para tallas
export const tallasAPI = {
  getAll: () => fetchAPI('/tallas'),
};

// Servicios para pedidos
export const pedidosAPI = {
  // Crear nuevo pedido
  create: (pedidoData) => fetchAPI('/pedidos', {
    method: 'POST',
    body: JSON.stringify(pedidoData),
  }),
};

const apiService = {
  productos: productosAPI,
  categorias: categoriasAPI,
  colores: coloresAPI,
  tallas: tallasAPI,
  pedidos: pedidosAPI,
};

export default apiService; 