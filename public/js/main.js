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
    const urlEdit = 'http://laravelsite.loc/update';
    const urlAdd = 'http://laravelsite.loc/addComment';
    $.ajax({
        method: 'POST',
        url: url,
        data: {
            user_id: user_id,
            text: text
        },
        success: function (data) {
            document.getElementById("text").value = '';
            let test = $("#all_comments").html();
            $("#all_comments").html('<div class="col" id="post-'+ data.id +'">' +
                '<div class="card shadow-sm"><div class="card-body">' +
                '<p class="card-text" id="card-text-'+ data.id +'">'+ text +'' +
                '<div class="d-flex justify-content-between align-items-center">' +
                '<div class="btn-group">' +
                '<small class="text-muted">'+ data.uName +'</small>' +
                '</div>' +
                '<small class="text-muted">'+ data.date +'</small>' +
                '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" ' +
                'onclick="getId('+ data.id +')" id=\'add-'+ data.id +'\' data-url=\''+ urlAdd +'\'>\n' +
                'Add comment' +
                '</button>' +
                '<button type=\'button\' class=\'btn btn-warning\' data-bs-toggle=\'modal\' data-bs-target=\'#editPost\' onclick=\'getId('+ data.id +')\' data-url=\''+ urlEdit + '\' id=\'edit-'+ data.id +'\'>Edit</button>' +
                '<button type=\'button\' class=\'btn btn-danger\' onclick=\'deletePost('+ data.id +')\' data-url=\''+ url + '/' + data.id + '\' id=\'delete-'+ data.id +'\'>Delete</button>' +
                '</div>' +
                '<div class="container g-3" id="commentsContainer-'+ data.id +'">' +
                '</div></div></div></div> ' + test)
        }
    });
}

function addComment() {
    id = globalId;
    check_csrf();
    let url = $("#add-" + id).data('url');
    let user_id = $("#user_id").val();
    let comment = document.getElementById("comment").value;
    const urlEdit = 'http://laravelsite.loc/editComment';
    const urlDelete = 'http://laravelsite.loc/dashboard/comment/';
    $.ajax({
        type: 'post',
        url: url,
        data: {
            user_id: user_id,
            post_id: id,
            comment: comment,
        },
        success: function (data) {
            document.getElementById("comment").value = "";
            document.getElementById("closeModal").click();
            let test = $("#commentsContainer-" + id).html();
            $("#commentsContainer-" + id).html('<div class="card w-50 mt-2" id="comment-' + data.id + '">' +
                '<div class="card-body" id="commentBody">' +
                '<p class="card-text" id="comment-text-'+ data.id +'">' + comment + '</p>' +
                '<small class="text-muted">' + data.uName + '</small> ' +
                '<small class="text-muted">' + data.date + '</small> ' +
                '<button type=\'button\' class=\'btn btn-warning\' data-bs-toggle=\'modal\' ' +
                'data-bs-target=\'#editComm\' onclick=\'getId('+ data.id +')\'' +
                'data-url=\''+ urlEdit +'\' id=\'editComm-'+ data.id +'\'>Edit</button>' + ' ' +
                '<button type=\'button\' class=\'btn btn-danger\' onclick=\'deleteComment(' + data.id + ')\'' +
                'data-url=\''+ urlDelete + data.id +'\' id=\'deleteComm-'+ data.id +'\'>Delete</button>' +
                '</div></div>' + test);
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
    let editedPost = document.getElementById("editedPost").value;
    $.ajax({
        type: 'POST',
        url: url,
        data: {
            editPost: true,
            editPostId: id,
            editPostText: editedPost,
            user_id: user_id
        },
        success: function (data) {
            document.getElementById("editedPost").value = "";
            document.getElementById("closeEditPost").click();
            document.getElementById("card-text-" + id).innerHTML = editedPost;
            console.log(data);
        }
    });
}


