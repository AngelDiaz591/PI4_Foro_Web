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