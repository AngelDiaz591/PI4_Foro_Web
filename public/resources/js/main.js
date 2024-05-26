// document.addEventListener('DOMContentLoaded', function() {
//     var show = document.getElementById('show_cate');
//     var categories = document.querySelector('.categories');
//     categories.addEventListener('click', function() {
//         show.classList.toggle('show_cat');
//         if (show.classList.contains('show_cat')) {
//             categories.querySelector('.more').textContent = 'View Less';
//         } else {
//             categories.querySelector('.more').textContent = 'View More';
//         }
//         localStorage.setItem('categorie_show', show.classList.contains('show_cat') ? 'show' : 'visible');
//     });

//     var categorieStatus = localStorage.getItem('categorie_show');
//     if (categorieStatus === 'show') {
//         show.classList.add('show_cat');
//         categories.querySelector('.more').textContent = 'View Less';
//     }
// });

document.addEventListener('DOMContentLoaded', function() {
    var mainNav = document.getElementById('main-nav');
    var mainSection = document.querySelector('main');
    
    function adjustMargin() {
      if (window.innerWidth < 800 && !!mainSection) {
        mainSection.style.margin = '0';
      } else if (!!mainSection) {
        mainSection.style.margin = '78px 25% 0 12%';
      }
    }

    var menuState = localStorage.getItem('menuVisible');
    if (menuState === 'hidden' && !!mainNav) {
        mainNav.classList.add('hide-nav');
        if (window.innerWidth >= 800 && !!mainSection) { 
            mainSection.style.margin = '78px 25% 0 0%';
        }
    } else if (menuState === 'visible' && !!mainNav) {
        mainNav.classList.remove('hide-nav');
        if (window.innerWidth >= 800 && !!mainSection) { 
            mainSection.style.margin = '78px 25% 0 12%';
        }
    }

    window.addEventListener('resize', adjustMargin);
});

toggleHideNav = (e) => {
  e.preventDefault();
  var mainNav = document.getElementById('main-nav');
  var mainSection = document.querySelector('main');

  mainNav.classList.toggle('hide-nav');
  if (window.innerWidth >= 800) {
    if (mainNav.classList.contains('hide-nav')) {
      mainSection.style.margin = '78px 25% 0 2%';
    } else {
      mainSection.style.margin = '78px 25% 0 12%';
    }
    localStorage.setItem('menuVisible', mainNav.classList.contains('hide-nav') ? 'hidden' : 'visible');
  }
}

// class CommentsHandler {
//     constructor() {
//         this.init();
//     }

//     init() {
//         document.addEventListener('DOMContentLoaded', () => {
//             const showCommentsButtons = document.querySelectorAll('.show-comments-btn');

//             showCommentsButtons.forEach((button) => {
//                 button.addEventListener('click', () => {
//                     const postId = button.parentElement.dataset.postId;
//                     const commentsSection = document.getElementById(`comments-${postId}`);

//                     console.log('postId:', postId);
//                     console.log('commentsSection:', commentsSection);

//                     if (commentsSection) {
//                         commentsSection.classList.toggle('comments-none');
//                     }
//                 });
//             });
//         });
//     }
// }

// new CommentsHandler();

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
