$(document).ready(function() {
    fetchComments(postId, userId);
    let currentEditingCommentId = null;

    $(document).on('click', '.comments-delete', function(e) {
        e.preventDefault(); 
        if(confirm('Are you sure you want to delete the comment?')) {
            const id = $(this).data('comment-id'); 
            $.post('/posts/delete_comments', { id: id }, (response) => {
                fetchComments(postId, userId);
            });
        }
    });

    $(document).on('click', '.comments-edit', function(e) {
        e.preventDefault();
        const id = $(this).data('comment-id');

        if (currentEditingCommentId !== null) {
            const previousEditContainer = $(`.comment-edit-container[data-comment-id="${currentEditingCommentId}"]`);
            previousEditContainer.empty();
        }

        const commentContent = $(this).closest('.parent-comment').find(`.comment-content[data-comment-id="${id}"] p`).text();
        const editTemplate = `
            <textarea class="comment-edit-textarea">${commentContent}</textarea>
            <button class="comments-update" data-comment-id="${id}">Update</button>
            <button class="comments-cancel">Cancel</button>
        `;
        $(this).closest('.parent-comment').find(`.comment-edit-container[data-comment-id="${id}"]`).html(editTemplate);
        currentEditingCommentId = id;
    });

    $(document).on('click', '.comments-cancel', function(e) {
        e.preventDefault();
        const commentId = $(this).closest('.comment-edit-container').data('comment-id');
        $(`.comment-edit-container[data-comment-id="${commentId}"]`).empty();
        currentEditingCommentId = null;
    });

    $(document).on('click', '.comments-update', function(e) {
        e.preventDefault();
        const id = $(this).data('comment-id');
        const updatedComment = $(this).closest('.comment').find('.comment-edit-textarea').val();
        $.post('/posts/edit_comments', { id: id, comment: updatedComment }, (response) => {
            fetchComments(postId, userId);
            edit = false;
        });
    });

    function fetchComments(postId) {
        $.ajax({
            url: '/posts/show_comments',
            type: 'POST',
            data: { postId: postId }, 
            success: function(response) {
                const comments = JSON.parse(response);
                let template = `<div class="comment-section" id="comments-container">`;
                comments.forEach(comment => {
                    if (comment.parent_comment_id === null) {
                        template += generateCommentHTML(comment, userId, comments);
                    }
                });
                template += `</div>`;
                $('#comments').html(template);
            }
        });
    }
    
    function generateCommentHTML(comment, userId, allComments, level = 0) {
        let margin = level * 5;
        let template = `<div class="comment" style="margin-left: ${margin}px;">`;
        template += `<div class="parent-comment">`;
        template += `<div class="user-info">`;
        template += `<i class='bx bxs-user-voice'></i>`;
        template += `<p>${comment.username}</p>`;
        template += `</div>`;
        template += `<div class="comment-content" data-comment-id="${comment.id}">`;
        template += `<p>${comment.comment}</p>`;
        template += `</div>`;
        template += `<div class="comment-edit-container" data-comment-id="${comment.id}"></div>`;
        template += `<p>${comment.created_at}</p>`;
        template += `<div class="comment-actions">`;

        const userIdInt = parseInt(userId);
        const commentUserIdInt = parseInt(comment.user_id);

        if (userIdInt === commentUserIdInt) {
            template += `<button class="comments-edit" data-comment-id="${comment.id}">Edit</button>`;
            template += `<button class="comments-delete" data-comment-id="${comment.id}">Delete</button>`;
        }

        if (userId !== null) {
            template += `<button class="comments-reply" data-comment-id="${comment.id}">Reply</button>`;
        }
        template += `</div>`;
        template += `</div>`;

        const childComments = allComments.filter(c => c.parent_comment_id === comment.id);
        if (childComments.length > 0) {
            level++; 
            childComments.forEach(childComment => {
                template += generateCommentHTML(childComment, userId, allComments, level);
            });
        }

        template += `</div>`; 

        return template;
    }

    $(document).on('click', '.comments-reply', function(e) {
        e.preventDefault();
        const id = $(this).data('comment-id');

        if (currentEditingCommentId !== null) {
            const previousEditContainer = $(`.comment-edit-container[data-comment-id="${currentEditingCommentId}"]`);
            previousEditContainer.empty();
        }

        const replyTemplate = `
            <textarea class="comment-create-textarea"></textarea>
            <button class="comments-create" data-parent-id="${id}">Create</button>
            <button class="comments-cancel">Cancel</button>
        `;

        const parentComment = $(this).closest('.parent-comment');
        parentComment.find(`.comment-edit-container[data-comment-id="${id}"]`).html(replyTemplate);
        currentEditingCommentId = id;
    });

    $(document).on('click', '.comments-create', function(e) {
        e.preventDefault();
        const parentCommentId = $(this).data('parent-id');
        const newComment = $(this).closest('.parent-comment').find('.comment-create-textarea').val();
        if (newComment.trim() !== '') {
            $.post('/posts/comments_son', {
                parentCommentId: parentCommentId,
                comment: newComment,
                postId: postId,
                userId: userId
            }, (response) => {
                fetchComments(postId, userId);
            });
        }
    });
});
