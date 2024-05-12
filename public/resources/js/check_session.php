<script>
function checkSession() {
    <?php if(!isset($_SESSION['user']['id'])): ?>
    while (true) {
        if (confirm("You need to log in to perform this action.")) {
            break; 
        }
    }
    <?php endif; ?>
}
</script>