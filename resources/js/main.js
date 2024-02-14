document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('categories').addEventListener('click', function() {
        var subcategories = document.querySelector('.subcategories');
        if (subcategories.style.display === 'none') {
            subcategories.style.display = 'block';
        } else {
            subcategories.style.display = 'none';
        }
    });
});

//funcion del ocultamiento del menu
// Función para mostrar u ocultar el menú según el ancho de la pantalla
function toggleNavVisibility() {
    var nav = document.querySelector('nav');
    if (window.innerWidth <= 800) {
        nav.classList.add('hide-nav');
    } else {
        nav.classList.remove('hide-nav');
    }
}

// Escucha el evento de redimensionamiento para ajustar el menú
window.addEventListener('resize', toggleNavVisibility);

// Función para mostrar u ocultar el menú al hacer clic en el icono
document.addEventListener('DOMContentLoaded', function() {
    var menuIcon = document.getElementById('menu-icon');
    var mainNav = document.getElementById('main-nav');
    menuIcon.addEventListener('click', function() {
        mainNav.classList.toggle('hide-nav');
        // Guarda el estado del menú en el almacenamiento local
        localStorage.setItem('menuVisible', mainNav.classList.contains('hide-nav') ? 'hidden' : 'visible');
    });

    // Restaura el estado del menú al cargar la página
    var menuState = localStorage.getItem('menuVisible');
    if (menuState === 'hidden') {
        mainNav.classList.add('hide-nav');
    }
});

// Llama a toggleNavVisibility al cargar la página para ajustar el menú inicialmente
document.addEventListener('DOMContentLoaded', toggleNavVisibility);
//ver mas texto/menos texto

document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.read-more-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            if (window.innerWidth <= 800) { // Verifica el ancho de la pantalla
                var hiddenParagraphs = this.parentNode.querySelectorAll('.text p.hidden');
                hiddenParagraphs.forEach(function(p) {
                    p.classList.remove('hidden');
                });
                this.style.display = 'none'; // Oculta el botón "Ver más"
                this.parentNode.querySelector('.read-less-btn').style.display = 'inline-block'; // Muestra el botón "Ver menos"
            } 
        });
    });

    document.querySelectorAll('.read-less-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            if (window.innerWidth <= 800) { // Verifica el ancho de la pantalla
                var hiddenParagraphs = this.parentNode.querySelectorAll('.text p:not(:first-child)');
                hiddenParagraphs.forEach(function(p) {
                    p.classList.add('hidden');
                });
                this.style.display = 'none'; // Oculta el botón "Ver menos"
                this.parentNode.querySelector('.read-more-btn').style.display = 'inline-block'; // Muestra el botón "Ver más"
            } 
        });
    });
});