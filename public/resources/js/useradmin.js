function showDeleteConfirmation(userId) {
    if (confirm("Are you sure you want to delete this user?")) {
        window.location.href = "/admins/user_delete/?id=" + userId;
    }
}
