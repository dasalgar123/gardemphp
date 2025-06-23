<?php
/**
 * ARCHIVO: Datos de productos
 * DESCRIPCIÓN: Contiene todos los datos de productos del catálogo
 */

// DATOS DE PRODUCTOS
$COLORES_COMERCIALES = ['Negro', 'Blanco', 'Gris', 'Azul marino', 'Rojo', 'Verde'];
$TALLAS_STD = ['S', 'M', 'L', 'XL'];
$TALLAS_NINOS = ['4', '6', '8', '10', '12'];

$ElementoProductos = [
    // Categoria: Caballeros
    [ 
        'id' => 1, 
        'nombre' => 'Boxer Sin Costura', 
        'descripcion' => 'Boxer sin costuras para máximo confort y libertad.', 
        'precio' => 32000, 
        'colores' => $COLORES_COMERCIALES, 
        'tallas' => $TALLAS_STD, 
        'imagen' => 'img/Caballeros/boxer1_1.jpeg', 
        'category' => 'Caballeros',
        'stock' => 35
    ],
    [ 
        'id' => 2, 
        'nombre' => 'Boxer Algodón Clásico', 
        'descripcion' => 'Boxer de algodón 100% premium con máxima comodidad y ajuste perfecto.', 
        'precio' => 25000, 
        'colores' => $COLORES_COMERCIALES, 
        'tallas' => $TALLAS_STD, 
        'imagen' => 'img/Caballeros/boxer2_1.jpeg', 
        'category' => 'Caballeros',
        'stock' => 50
    ],
    [ 
        'id' => 3, 
        'nombre' => 'Boxer Algodón Premium', 
        'descripcion' => 'Boxer premium de algodón orgánico con acabados de lujo.', 
        'precio' => 35000, 
        'colores' => $COLORES_COMERCIALES, 
        'tallas' => $TALLAS_STD, 
        'imagen' => 'img/Caballeros/boxer4_1.jpeg', 
        'category' => 'Caballeros',
        'stock' => 25
    ],
    [ 
        'id' => 4, 
        'nombre' => 'Boxer Mezcla Stretch', 
        'descripcion' => 'Boxer con mezcla de stretch para ajuste perfecto.', 
        'precio' => 28000, 
        'colores' => $COLORES_COMERCIALES, 
        'tallas' => $TALLAS_STD, 
        'imagen' => 'img/Caballeros/boxer5_1.jpeg', 
        'category' => 'Caballeros',
        'stock' => 40
    ],
    [ 
        'id' => 5, 
        'nombre' => 'Boxer Compresión Ligera', 
        'descripcion' => 'Boxer con compresión ligera para soporte muscular.', 
        'precio' => 38000, 
        'colores' => $COLORES_COMERCIALES, 
        'tallas' => $TALLAS_STD, 
        'imagen' => 'img/Caballeros/boxer6_1.jpg', 
        'category' => 'Caballeros',
        'stock' => 20
    ],

    // Categoria: Damas
    [ 
        'id' => 6, 
        'nombre' => 'Conjunto de Encaje Elegante', 
        'descripcion' => 'Con diseño elegante y femenino con acabados de encaje.', 
        'precio' => 45000, 
        'colores' => ['Negro', 'Blanco', 'Rosado'], 
        'tallas' => ['S', 'M', 'L'], 
        'imagen' => 'img/Damas/OIP.jpeg', 
        'category' => 'Damas',
        'stock' => 28
    ],
    [ 
        'id' => 7, 
        'nombre' => 'Bikini Clásico', 
        'descripcion' => 'Con ajuste cómodo y diseño atemporal.', 
        'precio' => 32000, 
        'colores' => ['Negro', 'Azul', 'Rojo'], 
        'tallas' => ['S', 'M', 'L'], 
        'imagen' => 'img/Damas/OIP (1).jpeg', 
        'category' => 'Damas',
        'stock' => 35
    ],
    [ 
        'id' => 8, 
        'nombre' => 'Conjunto Deportivo', 
        'descripcion' => 'Con tecnología de secado rápido y máxima comodidad.', 
        'precio' => 38000, 
        'colores' => ['Negro', 'Gris', 'Azul'], 
        'tallas' => ['S', 'M', 'L'], 
        'imagen' => 'img/Damas/OIP (2).jpeg', 
        'category' => 'Damas',
        'stock' => 22
    ],
    [ 
        'id' => 9, 
        'nombre' => 'Lencería Premium', 
        'descripcion' => 'Con acabados de seda y encaje de alta calidad.', 
        'precio' => 55000, 
        'colores' => ['Negro', 'Blanco', 'Bordó'], 
        'tallas' => ['S', 'M', 'L'], 
        'imagen' => 'img/Damas/OIP (3).jpeg', 
        'category' => 'Damas',
        'stock' => 15
    ],

    // Categoria: Niños
    [ 
        'id' => 10, 
        'nombre' => 'Boxer de Superhéroes', 
        'descripcion' => 'Divertido con diseños de superhéroes para niños.', 
        'precio' => 18000, 
        'colores' => ['Azul', 'Rojo', 'Verde'], 
        'tallas' => $TALLAS_NINOS, 
        'imagen' => 'img/Niños/boxer3_1.jpeg', 
        'category' => 'Niños',
        'stock' => 45
    ],
    [ 
        'id' => 11, 
        'nombre' => 'Boxer Deportivo Infantil', 
        'descripcion' => 'Con tecnología de secado rápido para niños activos.', 
        'precio' => 22000, 
        'colores' => ['Negro', 'Azul', 'Gris'], 
        'tallas' => $TALLAS_NINOS, 
        'imagen' => 'img/Niños/boxer5_1.jpeg', 
        'category' => 'Niños',
        'stock' => 38
    ],
    [ 
        'id' => 12, 
        'nombre' => 'Conjunto Deportivo Infantil', 
        'descripcion' => 'Completo para niños con máxima comodidad.', 
        'precio' => 28000, 
        'colores' => ['Azul', 'Rojo', 'Verde'], 
        'tallas' => $TALLAS_NINOS, 
        'imagen' => 'img/Niños/OIP.jpg', 
        'category' => 'Niños',
        'stock' => 25
    ],

    // Categoria: Niñas
    [ 
        'id' => 13, 
        'nombre' => 'Conjunto de Princesas', 
        'descripcion' => 'Suave con diseños de princesas para niñas.', 
        'precio' => 25000, 
        'colores' => ['Rosado', 'Lila', 'Blanco'], 
        'tallas' => $TALLAS_NINOS, 
        'imagen' => 'img/Niñas/OIP.jpeg', 
        'category' => 'Niñas',
        'stock' => 42
    ],
    [ 
        'id' => 14, 
        'nombre' => 'Bikini Infantil', 
        'descripcion' => 'Cómodo y seguro para niñas con diseños coloridos.', 
        'precio' => 20000, 
        'colores' => ['Rosado', 'Celeste', 'Amarillo'], 
        'tallas' => $TALLAS_NINOS, 
        'imagen' => 'img/Niñas/OIP (1).jpeg', 
        'category' => 'Niñas',
        'stock' => 35
    ],
    [ 
        'id' => 15, 
        'nombre' => 'Conjunto Deportivo Infantil', 
        'descripcion' => 'Para niñas activas con máxima libertad.', 
        'precio' => 26000, 
        'colores' => ['Rosado', 'Morado', 'Verde'], 
        'tallas' => $TALLAS_NINOS, 
        'imagen' => 'img/Niñas/OIP (2).jpeg', 
        'category' => 'Niñas',
        'stock' => 30
    ],
    [ 
        'id' => 16, 
        'nombre' => 'Conjunto Elegante Infantil', 
        'descripcion' => 'Para ocasiones especiales de niñas.', 
        'precio' => 30000, 
        'colores' => ['Blanco', 'Rosado', 'Lila'], 
        'tallas' => $TALLAS_NINOS, 
        'imagen' => 'img/Niñas/R.jpeg', 
        'category' => 'Niñas',
        'stock' => 20
    ]
];
?> 