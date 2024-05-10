$(document).ready(function() {
    
    const $commentsContainer = $('#comments');
    
    let currentEditingCommentId = null;

    $commentsContainer.on('click', '.comments-delete', function(e) {
        e.preventDefault();
        const id = $(this).data('comment-id');
        if (confirm('Are you sure you want to delete the comment?')) {
            $.post('/posts/delete_comments', { id: id }, () => fetchComments(postId, userId));
        }
    });

    $commentsContainer.on('click', '.comments-edit', function(e) {
        e.preventDefault();
        const id = $(this).data('comment-id');

        if (currentEditingCommentId !== null) {
            $(`.comment-edit-container[data-comment-id="${currentEditingCommentId}"]`).empty();
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

    $commentsContainer.on('click', '.comments-cancel', function(e) {
        e.preventDefault();
        const commentId = $(this).closest('.comment-edit-container').data('comment-id');
        $(`.comment-edit-container[data-comment-id="${commentId}"]`).empty();
        currentEditingCommentId = null;
    });

    $commentsContainer.on('click', '.comments-update', function(e) {
        e.preventDefault();
        const id = $(this).data('comment-id');
        const updatedComment = $(this).closest('.comment').find('.comment-edit-textarea').val();
        $.post('/posts/edit_comments', { id: id, comment: updatedComment }, () => fetchComments(postId, userId));
    });

    $commentsContainer.on('click', '.comments-reply', function(e) {
        e.preventDefault();
        const id = $(this).data('comment-id');

        if (currentEditingCommentId !== null) {
            $(`.comment-edit-container[data-comment-id="${currentEditingCommentId}"]`).empty();
        }

        const replyTemplate = `
            <textarea class="comment-create-textarea"></textarea>
            <button class="comments-create" data-parent-id="${id}">Create</button>
            <button class="comments-cancel">Cancel</button>
        `;

        $(this).closest('.parent-comment').find(`.comment-edit-container[data-comment-id="${id}"]`).html(replyTemplate);
        currentEditingCommentId = id;
    });

    $commentsContainer.on('click', '.comments-create', function(e) {
        e.preventDefault();
        const parentCommentId = $(this).data('parent-id');
        const newComment = $(this).closest('.parent-comment').find('.comment-create-textarea').val();
        if (newComment.trim() !== '') {
            $.post('/posts/comments_son', {
                parentCommentId: parentCommentId,
                comment: newComment,
                postId: postId,
                userId: app.user.id
                
            }, () => fetchComments(postId, userId));
        } 
    });

    function fetchComments(postId) {
        $.ajax({
            url: '/posts/show_comments',
            type: 'POST',
            data: { postId: postId },
            success: function(response) {
                const comments = JSON.parse(response);
                $commentsContainer.html(generateCommentsHTML(comments));
            }
        });
    }

    function generateCommentsHTML(comments) {
        let html = '';
        comments.forEach(comment => {
            html += generateCommentHTML(comment);
        });
        return html;
    }

    function generateCommentsHTML(comments) {
        let html = '';
        const parentComments = comments.filter(comment => comment.parent_comment_id === null);
        parentComments.forEach(parentComment => {
            html += generateCommentHTML(parentComment, comments);
        });
        return html;
    }
    
    function generateCommentHTML(comment, allComments, level = 0) {
        let html = `
            <div class="comment" style="margin-left: ${level * 5}px;">
                <div class="parent-comment">
                    <div class="user-info">
                        <i class='bx bxs-user-voice'></i>
                        <p>${comment.username}</p>
                    </div>
                    <div class="comment-content" data-comment-id="${comment.id}">
                        <p>${comment.comment}</p>
                    </div>
                    <div class="comment-edit-container" data-comment-id="${comment.id}"></div>
                    <p>${comment.created_at}</p>
                    <div class="comment-actions">`;
        if (userId === comment.user_id) {
            html += `<button class="comments-edit" data-comment-id="${comment.id}">Edit</button>`;
            html += `<button class="comments-delete" data-comment-id="${comment.id}">Delete</button>`;
        }
    
        if (userId !== null) {
            html += `<button class="comments-reply" data-comment-id="${comment.id}">Reply</button>`;
        }
    
        html += `</div></div>`;
    
        const childComments = allComments.filter(c => c.parent_comment_id === comment.id);
        childComments.forEach(childComment => {
            html += generateCommentHTML(childComment, allComments, level + 1);
        });
    
        html += `</div>`;
        return html;
    }

    fetchComments(postId);
});
