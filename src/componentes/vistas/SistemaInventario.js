import React, { useState, useEffect } from 'react';
import { Plus, Search, Edit, Trash2, Eye, Package, Users, ShoppingCart, TrendingUp, TrendingDown, AlertCircle, CheckCircle, X } from 'lucide-react';

const SistemaInventario = () => {
  // Estados principales
  const [vista, setVista] = useState('dashboard');
  const [modalAbierto, setModalAbierto] = useState(false);
  const [tipoModal, setTipoModal] = useState('');
  const [busqueda, setBusqueda] = useState('');
  const [itemSeleccionado, setItemSeleccionado] = useState(null);
  const [mensaje, setMensaje] = useState({ tipo: '', texto: '' });

  // Datos de ejemplo (en una app real vendrían de una API)
  const [productos, setProductos] = useState([
    { id: 1, codigo: 'P001', nombre: 'Laptop HP', categoria: 'Electrónicos', stock: 15, minimo: 5, precio: 1200, estado: 'activo', proveedor: 'TechCorp' },
    { id: 2, codigo: 'P002', nombre: 'Mouse Logitech', categoria: 'Accesorios', stock: 50, minimo: 10, precio: 25, estado: 'activo', proveedor: 'TechCorp' },
    { id: 3, codigo: 'P003', nombre: 'Teclado Mecánico', categoria: 'Accesorios', stock: 3, minimo: 5, precio: 80, estado: 'activo', proveedor: 'GameTech' },
    { id: 4, codigo: 'P004', nombre: 'Monitor Samsung', categoria: 'Electrónicos', stock: 0, minimo: 3, precio: 300, estado: 'inactivo', proveedor: 'DisplayCorp' }
  ]);

  const [proveedores, setProveedores] = useState([
    { id: 1, codigo: 'PROV001', nombre: 'TechCorp', contacto: 'Juan Pérez', email: 'juan@techcorp.com', telefono: '555-0123', estado: 'activo' },
    { id: 2, codigo: 'PROV002', nombre: 'GameTech', contacto: 'Ana García', email: 'ana@gametech.com', telefono: '555-0456', estado: 'activo' },
    { id: 3, codigo: 'PROV003', nombre: 'DisplayCorp', contacto: 'Carlos López', email: 'carlos@display.com', telefono: '555-0789', estado: 'inactivo' }
  ]);

  const [usuarios, setUsuarios] = useState([
    { id: 1, usuario: 'admin', nombre: 'Administrador', rol: 'Administrador', email: 'admin@empresa.com', estado: 'activo' },
    { id: 2, usuario: 'vendedor1', nombre: 'María Rodríguez', rol: 'Vendedor', email: 'maria@empresa.com', estado: 'activo' },
    { id: 3, usuario: 'almacen1', nombre: 'Pedro Sánchez', rol: 'Almacenero', email: 'pedro@empresa.com', estado: 'activo' }
  ]);

  const [movimientos, setMovimientos] = useState([
    { id: 1, tipo: 'entrada', producto: 'Laptop HP', cantidad: 10, fecha: '2024-06-01', usuario: 'admin', motivo: 'Compra' },
    { id: 2, tipo: 'salida', producto: 'Mouse Logitech', cantidad: 5, fecha: '2024-06-02', usuario: 'vendedor1', motivo: 'Venta' },
    { id: 3, tipo: 'entrada', producto: 'Teclado Mecánico', cantidad: 8, fecha: '2024-06-03', usuario: 'almacen1', motivo: 'Compra' },
    { id: 4, tipo: 'salida', producto: 'Teclado Mecánico', cantidad: 5, fecha: '2024-06-04', usuario: 'vendedor1', motivo: 'Venta' }
  ]);

  // Función para mostrar mensajes
  const mostrarMensaje = (tipo, texto) => {
    setMensaje({ tipo, texto });
    setTimeout(() => setMensaje({ tipo: '', texto: '' }), 3000);
  };

  // Función para abrir modal
  const abrirModal = (tipo, item = null) => {
    setTipoModal(tipo);
    setItemSeleccionado(item);
    setModalAbierto(true);
  };

  // Función para cerrar modal
  const cerrarModal = () => {
    setModalAbierto(false);
    setTipoModal('');
    setItemSeleccionado(null);
  };

  // Función para agregar/editar producto
  const guardarProducto = (formData) => {
    const nuevoProducto = {
      id: itemSeleccionado ? itemSeleccionado.id : Date.now(),
      codigo: formData.codigo,
      nombre: formData.nombre,
      categoria: formData.categoria,
      stock: parseInt(formData.stock),
      minimo: parseInt(formData.minimo),
      precio: parseFloat(formData.precio),
      estado: formData.estado || 'activo',
      proveedor: formData.proveedor
    };

    if (itemSeleccionado) {
      setProductos(productos.map(p => p.id === itemSeleccionado.id ? nuevoProducto : p));
      mostrarMensaje('success', 'Producto actualizado correctamente');
    } else {
      setProductos([...productos, nuevoProducto]);
      mostrarMensaje('success', 'Producto agregado correctamente');
    }
    cerrarModal();
  };

  // Función para cambiar estado de producto
  const cambiarEstadoProducto = (id, nuevoEstado) => {
    setProductos(productos.map(p => 
      p.id === id ? { ...p, estado: nuevoEstado } : p
    ));
    mostrarMensaje('success', `Producto ${nuevoEstado === 'activo' ? 'habilitado' : 'dado de baja'} correctamente`);
  };

  // Componente Proveedores completo
  const Proveedores = () => (
    <div className="space-y-6">
      <div className="flex justify-between items-center">
        <h2 className="text-xl font-semibold">Gestión de Proveedores</h2>
        <button
          onClick={() => abrirModal('agregar-proveedor')}
          className="bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center gap-2 hover:bg-blue-700"
        >
          <Plus className="h-4 w-4" />
          Agregar Proveedor
        </button>
      </div>

      <div className="bg-white p-4 rounded-lg shadow-sm border">
        <div className="overflow-x-auto">
          <table className="w-full">
            <thead>
              <tr className="border-b">
                <th className="text-left p-3">Código</th>
                <th className="text-left p-3">Nombre</th>
                <th className="text-left p-3">Contacto</th>
                <th className="text-left p-3">Email</th>
                <th className="text-left p-3">Teléfono</th>
                <th className="text-left p-3">Estado</th>
                <th className="text-left p-3">Acciones</th>
              </tr>
            </thead>
            <tbody>
              {proveedores.map(proveedor => (
                <tr key={proveedor.id} className="border-b hover:bg-gray-50">
                  <td className="p-3">{proveedor.codigo}</td>
                  <td className="p-3">{proveedor.nombre}</td>
                  <td className="p-3">{proveedor.contacto}</td>
                  <td className="p-3">{proveedor.email}</td>
                  <td className="p-3">{proveedor.telefono}</td>
                  <td className="p-3">
                    <span className={`px-2 py-1 rounded-full text-xs ${
                      proveedor.estado === 'activo' 
                        ? 'bg-green-100 text-green-800' 
                        : 'bg-red-100 text-red-800'
                    }`}>
                      {proveedor.estado}
                    </span>
                  </td>
                  <td className="p-3">
                    <div className="flex gap-2">
                      <button
                        onClick={() => abrirModal('editar-proveedor', proveedor)}
                        className="text-blue-600 hover:bg-blue-50 p-1 rounded"
                      >
                        <Edit className="h-4 w-4" />
                      </button>
                      <button
                        onClick={() => cambiarEstadoProveedor(
                          proveedor.id, 
                          proveedor.estado === 'activo' ? 'inactivo' : 'activo'
                        )}
                        className={`p-1 rounded ${
                          proveedor.estado === 'activo' 
                            ? 'text-red-600 hover:bg-red-50' 
                            : 'text-green-600 hover:bg-green-50'
                        }`}
                      >
                        {proveedor.estado === 'activo' ? <Trash2 className="h-4 w-4" /> : <CheckCircle className="h-4 w-4" />}
                      </button>
                    </div>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  );

  // Componente Ventas completo
  const Ventas = () => {
    const [ventasData] = useState([
      { id: 1, fecha: '2024-06-08', cliente: 'Juan Pérez', total: 1500, estado: 'pagada', vendedor: 'María' },
      { id: 2, fecha: '2024-06-07', cliente: 'Ana García', total: 250, estado: 'pendiente', vendedor: 'Carlos' },
      { id: 3, fecha: '2024-06-06', cliente: 'Pedro López', total: 800, estado: 'pagada', vendedor: 'María' },
      { id: 4, fecha: '2024-06-05', cliente: 'Laura Martín', total: 150, estado: 'anulada', vendedor: 'Carlos' }
    ]);

    return (
      <div className="space-y-6">
        <div className="flex justify-between items-center">
          <h2 className="text-xl font-semibold">Gestión de Ventas</h2>
          <button
            onClick={() => abrirModal('nueva-venta')}
            className="bg-green-600 text-white px-4 py-2 rounded-lg flex items-center gap-2 hover:bg-green-700"
          >
            <Plus className="h-4 w-4" />
            Nueva Venta
          </button>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div className="bg-green-50 p-6 rounded-lg border border-green-200">
            <div className="flex items-center justify-between">
              <div>
                <p className="text-green-600 text-sm font-medium">Ventas del Día</p>
                <p className="text-2xl font-bold text-green-800">
                  ${ventasData.filter(v => v.fecha === '2024-06-08' && v.estado === 'pagada')
                    .reduce((sum, v) => sum + v.total, 0)}
                </p>
              </div>
              <ShoppingCart className="h-8 w-8 text-green-600" />
            </div>
          </div>

          <div className="bg-blue-50 p-6 rounded-lg border border-blue-200">
            <div className="flex items-center justify-between">
              <div>
                <p className="text-blue-600 text-sm font-medium">Total Ventas</p>
                <p className="text-2xl font-bold text-blue-800">{ventasData.length}</p>
              </div>
              <Eye className="h-8 w-8 text-blue-600" />
            </div>
          </div>

          <div className="bg-yellow-50 p-6 rounded-lg border border-yellow-200">
            <div className="flex items-center justify-between">
              <div>
                <p className="text-yellow-600 text-sm font-medium">Pendientes</p>
                <p className="text-2xl font-bold text-yellow-800">
                  {ventasData.filter(v => v.estado === 'pendiente').length}
                </p>
              </div>
              <AlertCircle className="h-8 w-8 text-yellow-600" />
            </div>
          </div>
        </div>

        <div className="bg-white p-4 rounded-lg shadow-sm border">
          <div className="overflow-x-auto">
            <table className="w-full">
              <thead>
                <tr className="border-b">
                  <th className="text-left p-3">Fecha</th>
                  <th className="text-left p-3">Cliente</th>
                  <th className="text-left p-3">Total</th>
                  <th className="text-left p-3">Estado</th>
                  <th className="text-left p-3">Vendedor</th>
                  <th className="text-left p-3">Acciones</th>
                </tr>
              </thead>
              <tbody>
                {ventasData.map(venta => (
                  <tr key={venta.id} className="border-b hover:bg-gray-50">
                    <td className="p-3">{venta.fecha}</td>
                    <td className="p-3">{venta.cliente}</td>
                    <td className="p-3">${venta.total}</td>
                    <td className="p-3">
                      <span className={`px-2 py-1 rounded-full text-xs ${
                        venta.estado === 'pagada' ? 'bg-green-100 text-green-800' :
                        venta.estado === 'pendiente' ? 'bg-yellow-100 text-yellow-800' :
                        'bg-red-100 text-red-800'
                      }`}>
                        {venta.estado}
                      </span>
                    </td>
                    <td className="p-3">{venta.vendedor}</td>
                    <td className="p-3">
                      <div className="flex gap-2">
                        <button className="text-blue-600 hover:bg-blue-50 p-1 rounded">
                          <Eye className="h-4 w-4" />
                        </button>
                        <button className="text-green-600 hover:bg-green-50 p-1 rounded">
                          <Edit className="h-4 w-4" />
                        </button>
                      </div>
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        </div>
      </div>
    );
  };
  const registrarMovimiento = (formData) => {
    const nuevoMovimiento = {
      id: Date.now(),
      tipo: formData.tipo,
      producto: formData.producto,
      cantidad: parseInt(formData.cantidad),
      fecha: new Date().toISOString().split('T')[0],
      usuario: 'admin',
      motivo: formData.motivo
    };

    setMovimientos([...movimientos, nuevoMovimiento]);

    // Actualizar stock del producto
    const productoActualizar = productos.find(p => p.nombre === formData.producto);
    if (productoActualizar) {
      const nuevoStock = formData.tipo === 'entrada' 
        ? productoActualizar.stock + parseInt(formData.cantidad)
        : productoActualizar.stock - parseInt(formData.cantidad);
      
      setProductos(productos.map(p => 
        p.id === productoActualizar.id ? { ...p, stock: Math.max(0, nuevoStock) } : p
      ));
    }

    mostrarMensaje('success', `${formData.tipo === 'entrada' ? 'Entrada' : 'Salida'} registrada correctamente`);
    cerrarModal();
  };

  // Filtrar productos según búsqueda
  const productosFiltrados = productos.filter(producto =>
    producto.nombre.toLowerCase().includes(busqueda.toLowerCase()) ||
    producto.codigo.toLowerCase().includes(busqueda.toLowerCase()) ||
    producto.categoria.toLowerCase().includes(busqueda.toLowerCase())
  );

  // Componente Dashboard
  const Dashboard = () => (
    <div className="space-y-6">
      <div className="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div className="bg-blue-50 p-6 rounded-lg border border-blue-200">
          <div className="flex items-center justify-between">
            <div className="flex gap-3 pt-4">
              <button
                onClick={() => {
                  if (tipoModal.includes('producto')) {
                    guardarProducto(formData);
                  } else if (tipoModal === 'entrada' || tipoModal === 'salida') {
                    registrarMovimiento({ ...formData, tipo: tipoModal });
                  }
                }}
                className="flex-1 bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700"
              >
                Guardar
              </button>
              <button
                onClick={cerrarModal}
                className="flex-1 bg-gray-300 text-gray-700 py-2 rounded-lg hover:bg-gray-400"
              >
                Cancelar
              </button>
            </div>
          </div>>
              <p className="text-blue-600 text-sm font-medium">Total Productos</p>
              <p className="text-2xl font-bold text-blue-800">{productos.length}</p>
            </div>
            <Package className="h-8 w-8 text-blue-600" />
          </div>
        </div>

        <div className="bg-green-50 p-6 rounded-lg border border-green-200">
          <div className="flex items-center justify-between">
            <div>
              <p className="text-green-600 text-sm font-medium">Productos Activos</p>
              <p className="text-2xl font-bold text-green-800">{productos.filter(p => p.estado === 'activo').length}</p>
            </div>
            <CheckCircle className="h-8 w-8 text-green-600" />
          </div>
        </div>

        <div className="bg-yellow-50 p-6 rounded-lg border border-yellow-200">
          <div className="flex items-center justify-between">
            <div>
              <p className="text-yellow-600 text-sm font-medium">Stock Bajo</p>
              <p className="text-2xl font-bold text-yellow-800">{productos.filter(p => p.stock <= p.minimo).length}</p>
            </div>
            <AlertCircle className="h-8 w-8 text-yellow-600" />
          </div>
        </div>

        <div className="bg-purple-50 p-6 rounded-lg border border-purple-200">
          <div className="flex items-center justify-between">
            <div>
              <p className="text-purple-600 text-sm font-medium">Proveedores</p>
              <p className="text-2xl font-bold text-purple-800">{proveedores.length}</p>
            </div>
            <Users className="h-8 w-8 text-purple-600" />
          </div>
        </div>
      </div>

      <div className="bg-white p-6 rounded-lg shadow-sm border">
        <h3 className="text-lg font-semibold mb-4">Productos con Stock Bajo</h3>
        <div className="space-y-2">
          {productos.filter(p => p.stock <= p.minimo).map(producto => (
            <div key={producto.id} className="flex items-center justify-between p-3 bg-red-50 rounded-lg">
              <div>
                <p className="font-medium">{producto.nombre}</p>
                <p className="text-sm text-gray-600">Stock: {producto.stock} | Mínimo: {producto.minimo}</p>
              </div>
              <AlertCircle className="h-5 w-5 text-red-500" />
            </div>
          ))}
        </div>
      </div>
    </div>
  );

  // Componente Lista de Productos
  const ListaProductos = () => (
    <div className="space-y-6">
      <div className="flex justify-between items-center">
        <h2 className="text-xl font-semibold">Gestión de Productos</h2>
        <button
          onClick={() => abrirModal('agregar-producto')}
          className="bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center gap-2 hover:bg-blue-700"
        >
          <Plus className="h-4 w-4" />
          Agregar Producto
        </button>
      </div>

      <div className="bg-white p-4 rounded-lg shadow-sm border">
        <div className="flex gap-4 mb-4">
          <div className="flex-1">
            <input
              type="text"
              placeholder="Buscar productos..."
              value={busqueda}
              onChange={(e) => setBusqueda(e.target.value)}
              className="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
          </div>
          <button className="bg-gray-100 px-4 py-2 rounded-lg hover:bg-gray-200">
            <Search className="h-4 w-4" />
          </button>
        </div>

        <div className="overflow-x-auto">
          <table className="w-full">
            <thead>
              <tr className="border-b">
                <th className="text-left p-3">Código</th>
                <th className="text-left p-3">Nombre</th>
                <th className="text-left p-3">Categoría</th>
                <th className="text-left p-3">Stock</th>
                <th className="text-left p-3">Precio</th>
                <th className="text-left p-3">Estado</th>
                <th className="text-left p-3">Acciones</th>
              </tr>
            </thead>
            <tbody>
              {productosFiltrados.map(producto => (
                <tr key={producto.id} className="border-b hover:bg-gray-50">
                  <td className="p-3">{producto.codigo}</td>
                  <td className="p-3">{producto.nombre}</td>
                  <td className="p-3">{producto.categoria}</td>
                  <td className="p-3">
                    <span className={`px-2 py-1 rounded-full text-xs ${
                      producto.stock <= producto.minimo 
                        ? 'bg-red-100 text-red-800' 
                        : 'bg-green-100 text-green-800'
                    }`}>
                      {producto.stock}
                    </span>
                  </td>
                  <td className="p-3">${producto.precio}</td>
                  <td className="p-3">
                    <span className={`px-2 py-1 rounded-full text-xs ${
                      producto.estado === 'activo' 
                        ? 'bg-green-100 text-green-800' 
                        : 'bg-red-100 text-red-800'
                    }`}>
                      {producto.estado}
                    </span>
                  </td>
                  <td className="p-3">
                    <div className="flex gap-2">
                      <button
                        onClick={() => abrirModal('editar-producto', producto)}
                        className="text-blue-600 hover:bg-blue-50 p-1 rounded"
                      >
                        <Edit className="h-4 w-4" />
                      </button>
                      <button
                        onClick={() => cambiarEstadoProducto(
                          producto.id, 
                          producto.estado === 'activo' ? 'inactivo' : 'activo'
                        )}
                        className={`p-1 rounded ${
                          producto.estado === 'activo' 
                            ? 'text-red-600 hover:bg-red-50' 
                            : 'text-green-600 hover:bg-green-50'
                        }`}
                      >
                        {producto.estado === 'activo' ? <Trash2 className="h-4 w-4" /> : <CheckCircle className="h-4 w-4" />}
                      </button>
                    </div>
                  </td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  );

  // Componente Movimientos
  const Movimientos = () => (
    <div className="space-y-6">
      <div className="flex justify-between items-center">
        <h2 className="text-xl font-semibold">Movimientos de Inventario</h2>
        <div className="flex gap-2">
          <button
            onClick={() => abrirModal('entrada')}
            className="bg-green-600 text-white px-4 py-2 rounded-lg flex items-center gap-2 hover:bg-green-700"
          >
            <TrendingUp className="h-4 w-4" />
            Entrada
          </button>
          <button
            onClick={() => abrirModal('salida')}
            className="bg-red-600 text-white px-4 py-2 rounded-lg flex items-center gap-2 hover:bg-red-700"
          >
            <TrendingDown className="h-4 w-4" />
            Salida
          </button>
        </div>
      </div>

      <div className="bg-white p-4 rounded-lg shadow-sm border">
        <div className="overflow-x-auto">
          <table className="w-full">
            <thead>
              <tr className="border-b">
                <th className="text-left p-3">Fecha</th>
                <th className="text-left p-3">Tipo</th>
                <th className="text-left p-3">Producto</th>
                <th className="text-left p-3">Cantidad</th>
                <th className="text-left p-3">Usuario</th>
                <th className="text-left p-3">Motivo</th>
              </tr>
            </thead>
            <tbody>
              {movimientos.map(movimiento => (
                <tr key={movimiento.id} className="border-b hover:bg-gray-50">
                  <td className="p-3">{movimiento.fecha}</td>
                  <td className="p-3">
                    <span className={`px-2 py-1 rounded-full text-xs ${
                      movimiento.tipo === 'entrada' 
                        ? 'bg-green-100 text-green-800' 
                        : 'bg-red-100 text-red-800'
                    }`}>
                      {movimiento.tipo === 'entrada' ? 'Entrada' : 'Salida'}
                    </span>
                  </td>
                  <td className="p-3">{movimiento.producto}</td>
                  <td className="p-3">{movimiento.cantidad}</td>
                  <td className="p-3">{movimiento.usuario}</td>
                  <td className="p-3">{movimiento.motivo}</td>
                </tr>
              ))}
            </tbody>
          </table>
        </div>
      </div>
    </div>
  );

  // Modal Form Component
  const FormModal = () => {
    const [formData, setFormData] = useState({});

    useEffect(() => {
      if (itemSeleccionado) {
        setFormData(itemSeleccionado);
      } else {
        setFormData({});
      }
    }, [itemSeleccionado]);

    const handleSubmit = () => {
      if (tipoModal.includes('producto')) {
        guardarProducto(formData);
      } else if (tipoModal.includes('proveedor')) {
        guardarProveedor(formData);
      } else if (tipoModal === 'entrada' || tipoModal === 'salida') {
        registrarMovimiento({ ...formData, tipo: tipoModal });
      }
    };

    return (
      <div className="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div className="bg-white rounded-lg p-6 w-full max-w-md">
          <div className="flex justify-between items-center mb-4">
            <h3 className="text-lg font-semibold">
              {tipoModal === 'agregar-producto' && 'Agregar Producto'}
              {tipoModal === 'editar-producto' && 'Editar Producto'}
              {tipoModal === 'agregar-proveedor' && 'Agregar Proveedor'}
              {tipoModal === 'editar-proveedor' && 'Editar Proveedor'}
              {tipoModal === 'entrada' && 'Registrar Entrada'}
              {tipoModal === 'salida' && 'Registrar Salida'}
              {tipoModal === 'nueva-venta' && 'Nueva Venta'}
            </h3>
            <button onClick={cerrarModal} className="text-gray-400 hover:text-gray-600">
              <X className="h-5 w-5" />
            </button>
          </div>

          <div className="space-y-4">
            {tipoModal.includes('producto') && (
              <>
                <input
                  type="text"
                  placeholder="Código"
                  value={formData.codigo || ''}
                  onChange={(e) => setFormData({...formData, codigo: e.target.value})}
                  className="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                  required
                />
                <input
                  type="text"
                  placeholder="Nombre del producto"
                  value={formData.nombre || ''}
                  onChange={(e) => setFormData({...formData, nombre: e.target.value})}
                  className="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                  required
                />
                <input
                  type="text"
                  placeholder="Categoría"
                  value={formData.categoria || ''}
                  onChange={(e) => setFormData({...formData, categoria: e.target.value})}
                  className="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                  required
                />
                <input
                  type="number"
                  placeholder="Stock inicial"
                  value={formData.stock || ''}
                  onChange={(e) => setFormData({...formData, stock: e.target.value})}
                  className="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                  required
                />
                <input
                  type="number"
                  placeholder="Stock mínimo"
                  value={formData.minimo || ''}
                  onChange={(e) => setFormData({...formData, minimo: e.target.value})}
                  className="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                  required
                />
                <input
                  type="number"
                  step="0.01"
                  placeholder="Precio"
                  value={formData.precio || ''}
                  onChange={(e) => setFormData({...formData, precio: e.target.value})}
                  className="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                  required
                />
                <input
                  type="text"
                  placeholder="Proveedor"
                  value={formData.proveedor || ''}
                  onChange={(e) => setFormData({...formData, proveedor: e.target.value})}
                  className="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                  required
                />
              </>
            )}

            {tipoModal.includes('proveedor') && (
              <>
                <input
                  type="text"
                  placeholder="Código del proveedor"
                  value={formData.codigo || ''}
                  onChange={(e) => setFormData({...formData, codigo: e.target.value})}
                  className="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                  required
                />
                <input
                  type="text"
                  placeholder="Nombre del proveedor"
                  value={formData.nombre || ''}
                  onChange={(e) => setFormData({...formData, nombre: e.target.value})}
                  className="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                  required
                />
                <input
                  type="text"
                  placeholder="Contacto principal"
                  value={formData.contacto || ''}
                  onChange={(e) => setFormData({...formData, contacto: e.target.value})}
                  className="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                  required
                />
                <input
                  type="email"
                  placeholder="Email"
                  value={formData.email || ''}
                  onChange={(e) => setFormData({...formData, email: e.target.value})}
                  className="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                  required
                />
                <input
                  type="tel"
                  placeholder="Teléfono"
                  value={formData.telefono || ''}
                  onChange={(e) => setFormData({...formData, telefono: e.target.value})}
                  className="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                  required
                />
              </>
            )}

            {tipoModal === 'nueva-venta' && (
              <>
                <input
                  type="text"
                  placeholder="Cliente"
                  value={formData.cliente || ''}
                  onChange={(e) => setFormData({...formData, cliente: e.target.value})}
                  className="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                  required
                />
                <select
                  value={formData.producto || ''}
                  onChange={(e) => setFormData({...formData, producto: e.target.value})}
                  className="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                  required
                >
                  <option value="">Seleccionar producto</option>
                  {productos.filter(p => p.estado === 'activo' && p.stock > 0).map(producto => (
                    <option key={producto.id} value={producto.nombre}>
                      {producto.nombre} (Stock: {producto.stock})
                    </option>
                  ))}
                </select>
                <input
                  type="number"
                  placeholder="Cantidad"
                  value={formData.cantidad || ''}
                  onChange={(e) => setFormData({...formData, cantidad: e.target.value})}
                  className="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                  required
                />
                <input
                  type="number"
                  step="0.01"
                  placeholder="Total"
                  value={formData.total || ''}
                  onChange={(e) => setFormData({...formData, total: e.target.value})}
                  className="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                  required
                />
              </>
            )}

            {(tipoModal === 'entrada' || tipoModal === 'salida') && (
              <>
                <select
                  value={formData.producto || ''}
                  onChange={(e) => setFormData({...formData, producto: e.target.value})}
                  className="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                  required
                >
                  <option value="">Seleccionar producto</option>
                  {productos.filter(p => p.estado === 'activo').map(producto => (
                    <option key={producto.id} value={producto.nombre}>{producto.nombre}</option>
                  ))}
                </select>
                <input
                  type="number"
                  placeholder="Cantidad"
                  value={formData.cantidad || ''}
                  onChange={(e) => setFormData({...formData, cantidad: e.target.value})}
                  className="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                  required
                />
                <input
                  type="text"
                  placeholder="Motivo"
                  value={formData.motivo || ''}
                  onChange={(e) => setFormData({...formData, motivo: e.target.value})}
                  className="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                  required
                />
              </>
            )}

            <div className="flex gap-3 pt-4">
              <button
                type="submit"
                className="flex-1 bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700"
              >
                Guardar
              </button>
              <button
                type="button"
                onClick={cerrarModal}
                className="flex-1 bg-gray-300 text-gray-700 py-2 rounded-lg hover:bg-gray-400"
              >
                Cancelar
              </button>
            </div>
          </form>
        </div>
      </div>
    );
  };

  return (
    <div className="min-h-screen bg-gray-50">
      {/* Header */}
      <header className="bg-white shadow-sm border-b">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="flex justify-between items-center py-4">
            <h1 className="text-2xl font-bold text-gray-900">Sistema de Inventario</h1>
            <div className="text-sm text-gray-600">
              Administrador | {new Date().toLocaleDateString()}
            </div>
          </div>
        </div>
      </header>

      {/* Navigation */}
      <nav className="bg-white shadow-sm border-b">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div className="flex space-x-8">
            {[
              { id: 'dashboard', label: 'Dashboard', icon: Eye },
              { id: 'productos', label: 'Productos', icon: Package },
              { id: 'movimientos', label: 'Movimientos', icon: TrendingUp },
              { id: 'proveedores', label: 'Proveedores', icon: Users },
              { id: 'ventas', label: 'Ventas', icon: ShoppingCart }
            ].map(item => (
              <button
                key={item.id}
                onClick={() => setVista(item.id)}
                className={`flex items-center gap-2 px-3 py-4 border-b-2 text-sm font-medium ${
                  vista === item.id
                    ? 'border-blue-500 text-blue-600'
                    : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'
                }`}
              >
                <item.icon className="h-4 w-4" />
                {item.label}
              </button>
            ))}
          </div>
        </div>
      </nav>

      {/* Main Content */}
      <main className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {/* Mensajes */}
        {mensaje.texto && (
          <div className={`mb-4 p-4 rounded-lg ${
            mensaje.tipo === 'success' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'
          }`}>
            {mensaje.texto}
          </div>
        )}

        {/* Contenido según vista */}
        {vista === 'dashboard' && <Dashboard />}
        {vista === 'productos' && <ListaProductos />}
        {vista === 'movimientos' && <Movimientos />}
        {vista === 'proveedores' && (
          <div className="text-center py-12">
            <Users className="h-12 w-12 text-gray-400 mx-auto mb-4" />
            <h3 className="text-lg font-medium text-gray-900 mb-2">Gestión de Proveedores</h3>
            <p className="text-gray-600">Módulo en desarrollo</p>
          </div>
        )}
        {vista === 'ventas' && (
          <div className="text-center py-12">
            <ShoppingCart className="h-12 w-12 text-gray-400 mx-auto mb-4" />
            <h3 className="text-lg font-medium text-gray-900 mb-2">Gestión de Ventas</h3>
            <p className="text-gray-600">Módulo en desarrollo</p>
          </div>
        )}
      </main>

      {/* Modal */}
      {modalAbierto && <FormModal />}
    </div>
  );
};

export default SistemaInventario;