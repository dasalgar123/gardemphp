<div class="carrucel-container">
    <div class="carrucel-slides">
        <div class="carrucel-slide active">
            <img src="img/logo/1.webp" alt="Slide 1" class="carrucel-imagen">
            <div class="carrucel-contenido">
                <h2>Bienvenido a Gardem</h2>
                <p>Descubre nuestra colección de ropa interior de alta calidad</p>
            </div>
        </div>
        <div class="carrucel-slide">
            <img src="img/logo/2.webp" alt="Slide 2" class="carrucel-imagen">
            <div class="carrucel-contenido">
                <h2>Calidad Premium</h2>
                <p>Los mejores materiales para tu comodidad</p>
            </div>
        </div>
        <div class="carrucel-slide">
            <img src="img/logo/OIP.webp" alt="Slide 3" class="carrucel-imagen">
            <div class="carrucel-contenido">
                <h2>Diseños Exclusivos</h2>
                <p>Estilo y elegancia en cada prenda</p>
            </div>
        </div>
    </div>
    
    <button class="carrucel-btn carrucel-btn-prev" onclick="cambiarSlide(-1)">❮</button>
    <button class="carrucel-btn carrucel-btn-next" onclick="cambiarSlide(1)">❯</button>
    
    <div class="carrucel-indicadores">
        <span class="carrucel-indicador active" onclick="slideActual(1)"></span>
        <span class="carrucel-indicador" onclick="slideActual(2)"></span>
        <span class="carrucel-indicador" onclick="slideActual(3)"></span>
    </div>
</div>

<script>
let slideIndex = 1;
mostrarSlides(slideIndex);

function cambiarSlide(n) {
    mostrarSlides(slideIndex += n);
}

function slideActual(n) {
    mostrarSlides(slideIndex = n);
}

function mostrarSlides(n) {
    let i;
    let slides = document.getElementsByClassName("carrucel-slide");
    let indicadores = document.getElementsByClassName("carrucel-indicador");
    
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < indicadores.length; i++) {
        indicadores[i].className = indicadores[i].className.replace(" active", "");
    }
    
    slides[slideIndex-1].style.display = "block";
    indicadores[slideIndex-1].className += " active";
}

// Auto slide cada 5 segundos
setInterval(function() {
    cambiarSlide(1);
}, 5000);
</script> 