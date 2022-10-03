@section('commentReplyContent')
    <div class="card w-75 mt-2" id="comment-{{ $responseReplyCommentArray['id'] }}">
        <div class="card-body" id="commentBody">
            <p class="card-text" id="comment-text-{{ $responseReplyCommentArray['id'] }}">{{ $responseReplyCommentArray['comment'] }}</p>
            <small class="text-muted">{{ $responseReplyCommentArray['uName'] }}</small>
            <small class="text-muted">{{ $responseReplyCommentArray['date'] }}</small>
            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                    data-bs-target="#addReply"
                    data-url="{{ route('reply.add') }}" onclick="getId({{ $responseReplyCommentArray['id'] }})"
                    id="addReply-{{ $responseReplyCommentArray['id'] }}">{{ __('dashboard.reply') }}</button>
            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                    data-bs-target="#editComm" onclick="getId({{ $responseReplyCommentArray['id'] }})"
                    data-url="{{ route('comment.editComment') }}"
                    id="editComm-{{ $responseReplyCommentArray['id'] }}">{{ __('dashboard.edit-button') }}</button>
            <button type="button" class="btn btn-danger"
                    onclick="deleteComment({{ $responseReplyCommentArray['id'] }})"
                    id="deleteComm-{{ $responseReplyCommentArray['id'] }}"
                    data-url="{{ route('comment.destroy', $responseReplyCommentArray['id']) }}">{{ __('dashboard.delete-button') }}</button>
            <div class="container g-3" id="commentsReplyContainer-{{ $responseReplyCommentArray['id'] }}">
            </div>
        </div>
    </div>
@endsection
