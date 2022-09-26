@section('commentContent')
    <div class="card w-50 mt-2" id="comment-{{ $responseCommentArray['id'] }}">
        <div class="card-body" id="commentBody">
            <p class="card-text" id="comment-text-{{ $responseCommentArray['id'] }}">{{ $responseCommentArray['comment'] }}</p>
            <small class="text-muted">{{ $responseCommentArray['uName'] }}</small>
            <small class="text-muted">{{ $responseCommentArray['date'] }}</small>
            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                    data-bs-target="#editComm" onclick="getId({{ $responseCommentArray['id'] }})"
                    data-url="{{ route('comment.editComment') }}"
                    id="editComm-{{ $responseCommentArray['id'] }}">{{ __('dashboard.edit-button') }}</button>
            <button type="button" class="btn btn-danger"
                    onclick="deleteComment({{ $responseCommentArray['id'] }})"
                    id="deleteComm-{{ $responseCommentArray['id'] }}"
                    data-url="{{ route('comment.destroy', $responseCommentArray['id']) }}">{{ __('dashboard.delete-button') }}</button>
        </div>
    </div>
@endsection
