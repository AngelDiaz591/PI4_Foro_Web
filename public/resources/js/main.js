document.addEventListener('DOMContentLoaded', function() {
    var show = document.getElementById('show_cate');
    var categories = document.querySelector('.categories');
    categories.addEventListener('click', function() {
        show.classList.toggle('show_cat');
        if (show.classList.contains('show_cat')) {
            categories.querySelector('.more').textContent = 'View Less';
        } else {
            categories.querySelector('.more').textContent = 'View More';
        }
        localStorage.setItem('categorie_show', show.classList.contains('show_cat') ? 'show' : 'visible');
    });

    var categorieStatus = localStorage.getItem('categorie_show');
    if (categorieStatus === 'show') {
        show.classList.add('show_cat');
        categories.querySelector('.more').textContent = 'View Less';
    }
});

document.addEventListener('DOMContentLoaded', function() {
    var menuIcon = document.getElementById('menu-icon');
    var mainNav = document.getElementById('main-nav');
    var mainSection = document.querySelector('main');
    
    // Función para ajustar el margen según el tamaño de la pantalla
    function adjustMargin() {
        if (window.innerWidth < 800) {
            mainSection.style.margin = '0'; // Si la pantalla es menor a 800px, establece el margen a 0
        } else {
            mainSection.style.margin = '78px 25% 0 12%'; // Si la pantalla es mayor o igual a 800px, establece el margen original
        }
    }

    menuIcon.addEventListener('click', function() {
        mainNav.classList.toggle('hide-nav');
        if (window.innerWidth >= 800) { // Solo ajusta el margen si la pantalla es mayor o igual a 800px
            if (mainNav.classList.contains('hide-nav')) {
                mainSection.style.margin = '78px 25% 0 2%'; // Si se oculta el menú, cambia el margen izquierdo del <main> a 0
            } else {
                mainSection.style.margin = '78px 25% 0 12%'; // Si se muestra el menú, establece el margen izquierdo original del <main>
            }
            // Almacena el estado del menú en el localStorage
            localStorage.setItem('menuVisible', mainNav.classList.contains('hide-nav') ? 'hidden' : 'visible');
        }
    });

    // Recupera el estado del menú del almacenamiento local y ajusta el margen en consecuencia
    var menuState = localStorage.getItem('menuVisible');
    if (menuState === 'hidden') {
        mainNav.classList.add('hide-nav');
        if (window.innerWidth >= 800) { // Solo ajusta el margen si la pantalla es mayor o igual a 800px
            mainSection.style.margin = '78px 25% 0 0%'; // Si se oculta el menú, establece el margen izquierdo del <main> a 0
        }
    } else if (menuState === 'visible') {
        mainNav.classList.remove('hide-nav');
        if (window.innerWidth >= 800) { // Solo ajusta el margen si la pantalla es mayor o igual a 800px
            mainSection.style.margin = '78px 25% 0 12%'; // Si se muestra el menú, establece el margen izquierdo original del <main>
        }
    }

    // Añade un event listener para ajustar el margen cuando cambia el tamaño de la ventana
    window.addEventListener('resize', adjustMargin);

});

class CommentsHandler {
    constructor() {
        this.init();
    }

    init() {
        document.addEventListener('DOMContentLoaded', () => {
            const showCommentsButtons = document.querySelectorAll('.show-comments-btn');

            showCommentsButtons.forEach((button) => {
                button.addEventListener('click', () => {
                    const postId = button.parentElement.dataset.postId;
                    const commentsSection = document.getElementById(`comments-${postId}`);

                    console.log('postId:', postId);
                    console.log('commentsSection:', commentsSection);

                    if (commentsSection) {
                        commentsSection.classList.toggle('comments-none');
                    }
                });
            });
        });
    }
}

new CommentsHandler();

function autoSize(textarea) {
    textarea.style.height = 'auto';
    textarea.style.height = textarea.scrollHeight + 'px';
}

// document.addEventListener('DOMContentLoaded', function () {
//     const openModalElements = document.querySelectorAll('.openModal');
//     const modal = document.getElementById('modal');
//     const closeModalBtn = document.querySelector('.close-modal');
  
//     openModalElements.forEach(element => {
//       element.addEventListener('click', function () {
//         modal.style.display = 'flex';
//       });
//     });
  
//     function closeModal() {
//       modal.style.display = 'none';
//     }
  
//     closeModalBtn.addEventListener('click', function () {
//       closeModal();
//     });
  
//     modal.addEventListener('click', function (event) {
//       if (event.target === modal) {
//         closeModal();
//       }
//     });
  
//     document.addEventListener('keydown', function (event) {
//       if (event.key === 'Escape') {
//         closeModal();
//       }
//     });
// });

function toggleExtraImages() {
    const extraImages = document.querySelectorAll('.image img:nth-child(n+4)');
    extraImages.forEach(image => {
        image.style.display = image.style.display === 'none' ? 'block' : 'none';
    });
}

function toggleModal() {
    var modal = document.getElementById("myModal");
    modal.style.display = modal.style.display === "block" ? "none" : "block";
}

function openModal(postId) {
    const modal = document.getElementById(`myModal-${postId}`);
    modal.style.display = "block";
    currentSlide(1, postId);
}

function closeModal(postId) {
    const modal = document.getElementById(`myModal-${postId}`);
    modal.style.display = "none";
}

let slideIndex = {};

function currentSlide(n, postId) {
    showSlides(slideIndex[postId] = n, postId);
}

function changeSlide(n, postId) {
    showSlides(slideIndex[postId] += n, postId);
}

function showSlides(n, postId) {
    let i;
    let slides = document.querySelectorAll(`#carouselContainer-${postId} .carousel-slide`);
    if (n > slides.length) { slideIndex[postId] = 1 }
    if (n < 1) { slideIndex[postId] = slides.length }
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slides[slideIndex[postId] - 1].style.display = "block";
}

window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
        event.target.style.display = "none";
    }
}
