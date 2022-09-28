function check_csrf() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
}

let globalId;

function getId(id) {
    globalId = id;
}

function checkForm() {
    let x = document.forms["registerForm"]["phone"].value;
    let phone = "^(0\d{9})$";
    if (x != phone) {
        return "Wrong number"
    }
}

function deleteComment(id) {
    check_csrf();
    let url = $("#deleteComm-" + id).data('url');
    if (confirm("Do you want delete this comment?")) {
        $.ajax({
            type:    'DELETE',
            url:    url,
            data:   'commentDeleteId=' + id,
            success: function (data) {
                if (data) {
                    $("#comment-" + id).remove();
                }
            }
        });
    }
}

function deletePost(id) {
    check_csrf();
    let url = $("#delete-" + id).data('url');
    if (confirm("Do you want delete this comment?")) {
        $.ajax({
            type:    'DELETE',
            url:    url,
            data:   'id=' + id,
            success: function (data) {
                if (data) {
                    $("#post-" + id).remove();
                }
            }
        });
    }
}

function addPost() {
    check_csrf();
    event.preventDefault();
    let text = $("#text").val();
    let user_id = $("#user_id").val();
    let url = $("#submitButton").data('url');
    let locale = $("#locale").val();

    var fileInput = document.getElementById('uploadFile');
    var file = fileInput.files[0];
    var formData = new FormData();
    formData.append('file', file);
    formData.append('text', text);
    formData.append('user_id', user_id);
    formData.append('locale', locale);
    $.ajax({
        method: 'POST',
        url: url,
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            document.getElementById("text").value = '';
            if (locale === 'en') {
                let test = $("#all_comments").html();
                $('#all_comments').html(data.html + test);
            }
            else if (locale === 'ru') {
                let test = $("#all_comments").html();
                $('#all_comments').html(data.html + test);
            }
            else if (locale === 'uk') {
                let test = $("#all_comments").html();
                $('#all_comments').html(data.html + test);
            }
        }
    });
}

function addComment() {
    id = globalId;
    check_csrf();
    let url = $("#add-" + id).data('url');
    let user_id = $("#user_id").val();
    let locale = $("#locale").val();
    let comment = document.getElementById("comment").value;
    $.ajax({
        type: 'post',
        url: url,
        data: {
            user_id: user_id,
            post_id: id,
            comment: comment,
            locale: locale
        },
        success: function (data) {
            document.getElementById("comment").value = "";
            document.getElementById("closeModal").click();
            if (locale === 'en') {
                let test = $("#commentsContainer-" + id).html();
                $('#commentsContainer-' + id).html(data.html + test);
            }
            else if (locale === 'ru') {
                let test = $("#commentsContainer-" + id).html();
                $('#commentsContainer-' + id).html(data.html + test);
            }
            else if (locale === 'uk') {
                let test = $("#commentsContainer-" + id).html();
                $('#commentsContainer-' + id).html(data.html + test);
            }
        }
    });
}

function editComment() {
    id = globalId;
    check_csrf();
    let url = $("#editComm-" + id).data('url');
    let editedComment = document.getElementById("editedComment").value;
    $.ajax({
        type: 'post',
        url: url,
        data: {
            edit: true,
            editCommentId: id,
            editCommentText: editedComment
        },
        success: function (data) {
            document.getElementById("editedComment").value = "";
            document.getElementById("closeEdit").click();
            document.getElementById("comment-text-" + id).innerHTML = editedComment;
        }
    });
}

function editPost() {
    check_csrf();
    id = globalId;
    let url = $("#edit-" + id).data('url');
    let user_id = $("#user_id").val();
    let locale = $("#locale").val();
    let editedPost = document.getElementById("editedPost").value;
    $.ajax({
        type: 'POST',
        url: url,
        data: {
            editPost: true,
            editPostId: id,
            editPostText: editedPost,
            user_id: user_id,
            locale: locale
        },
        success: function (data) {
            document.getElementById("editedPost").value = "";
            document.getElementById("closeEditPost").click();
            document.getElementById("card-text-" + id).innerHTML = editedPost;
            console.log(data);
        }
    });
}
