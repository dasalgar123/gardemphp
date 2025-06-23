<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo - Gardem</title>
    
</head>
<body>

<div class="container">
    <!-- Carrusel de Productos -->
    <div class="carrucel-container">
        <div class="carrucel-slides">
            <!-- Producto 1: Boxer Clásico -->
            <div class="carrucel-slide active">
                <div class="producto-contenido">
                    <h2>Boxer Clásico</h2>
                    <p>Cómodo y resistente para uso diario. Telas de alta calidad que brindan comodidad todo el día.</p>
                    <div class="producto-precio">$6.000</div>
                </div>
            </div>

            <!-- Producto 2: Pack Oferta -->
            <div class="carrucel-slide">
                <div class="producto-contenido">
                    <div class="producto-oferta">¡OFERTA ESPECIAL!</div>
                    <h2>Pack 12 Boxer</h2>
                    <p>Ahorra más con nuestro pack familiar. Calidad garantizada para toda la familia.</p>
                    <div class="producto-precio">$72.000</div>
                </div>
            </div>

            <!-- Producto 3: Ropa Femenina -->
            <div class="carrucel-slide">
                <div class="producto-contenido">
                    <h2>Ropa Interior Femenina</h2>
                    <p>Comodidad y elegancia en cada diseño. Perfecta para el día a día con estilo.</p>
                    <div class="producto-precio">$8.000</div>
                </div>
            </div>

            <!-- Producto 4: Ropa Infantil -->
            <div class="carrucel-slide">
                <div class="producto-contenido">
                    <h2>Ropa Interior Infantil</h2>
                    <p>Suave y cómoda para los más pequeños. Telas hipoalergénicas y resistentes.</p>
                    <div class="producto-precio">$5.000</div>
                </div>
            </div>

            <!-- Producto 5: Envío Gratis -->
            <div class="carrucel-slide">
                <div class="producto-contenido">
                    <div class="producto-oferta">ENVÍO GRATIS</div>
                    <h2>Envíos a Toda Colombia</h2>
                    <p>Recibe tus productos en la comodidad de tu hogar. Envío gratis a Cúcuta y todo el país.</p>
                    <div class="producto-precio">Sin costo adicional</div>
                </div>
            </div>

            <!-- Producto 6: Horario -->
            <div class="carrucel-slide">
                <div class="producto-contenido">
                    <h2>Horario de Despacho</h2>
                    <p>Procesamos y enviamos tu pedido después de las 5 PM en jornada laboral.</p>
                    <div class="producto-precio">Servicio garantizado</div>
                </div>
            </div>
        </div>
    </div>

    
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.carrucel-slide');
    let currentSlide = 0;
    
    if (slides.length === 0) return;
    
    function nextSlide() {
        slides[currentSlide].classList.remove('active');
        currentSlide = (currentSlide + 1) % slides.length;
        slides[currentSlide].classList.add('active');
    }
    
    // Cambiar cada 4 segundos para dar tiempo a leer
    setInterval(nextSlide, 4000);
});
</script>

</body>
</html>