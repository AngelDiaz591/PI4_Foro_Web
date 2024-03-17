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
    menuIcon.addEventListener('click', function() {
        mainNav.classList.toggle('hide-nav');
        localStorage.setItem('menuVisible', mainNav.classList.contains('hide-nav') ? 'hidden' : 'visible');
    });

    var menuState = localStorage.getItem('menuVisible');
    if (menuState === 'hidden') {
        mainNav.classList.add('hide-nav');
    }
});



const main = {
    verFotos: function(rutaImagen) {
        const fotoModal = document.getElementById("foto");
        fotoModal.src = rutaImagen;
        main.modalFoto.style.display = "block";
    }
};

document.addEventListener("DOMContentLoaded", function() {
    main.modalFoto = document.querySelector("#modal-foto");
    main.foto = document.querySelector("#foto");

    window.onload = function() {
        document.querySelector("#close-modal").addEventListener("click", () => {
            main.modalFoto.style.display = "none";
        });
    };

    window.onclick = event => {
        if(event.target == main.modalFoto) {
            main.modalFoto.style.display = "none";
        }
    };
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

document.addEventListener('DOMContentLoaded', function () {
    const openModalElements = document.querySelectorAll('.openModal');
    const modal = document.getElementById('modal');
    const closeModalBtn = document.querySelector('.close-modal');
  
    openModalElements.forEach(element => {
      element.addEventListener('click', function () {
        modal.style.display = 'flex';
      });
    });
  
    function closeModal() {
      modal.style.display = 'none';
    }
  
    closeModalBtn.addEventListener('click', function () {
      closeModal();
    });
  
    modal.addEventListener('click', function (event) {
      if (event.target === modal) {
        closeModal();
      }
    });
  
    document.addEventListener('keydown', function (event) {
      if (event.key === 'Escape') {
        closeModal();
      }
    });
});