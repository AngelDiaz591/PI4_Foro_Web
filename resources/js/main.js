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
function toggleNavVisibility() {
    var nav = document.querySelector('nav');
    if (window.innerWidth <= 800) {
        nav.classList.add('hide-nav');
    } else {
        nav.classList.remove('hide-nav');
    }
}
window.addEventListener('resize', toggleNavVisibility);

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

document.addEventListener('DOMContentLoaded', toggleNavVisibility);

document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll('.read-less-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            if (window.innerWidth <= 800) { 
                var hiddenParagraphs = this.parentNode.querySelectorAll('.text p:not(:first-child)');
                hiddenParagraphs.forEach(function(p) {
                    p.classList.add('hidden');
                });
                this.style.display = 'none'; 
                this.parentNode.querySelector('.read-more-btn').style.display = 'inline-block'; 
            } 
        });
    });

    document.querySelectorAll('.read-more-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            if (window.innerWidth <= 800) { 
                var hiddenParagraphs = this.parentNode.querySelectorAll('.text p.hidden');
                hiddenParagraphs.forEach(function(p) {
                    p.classList.remove('hidden');
                });
                this.style.display = 'none'; 
                this.parentNode.querySelector('.read-less-btn').style.display = 'inline-block';
            } 
        });
    });
});
