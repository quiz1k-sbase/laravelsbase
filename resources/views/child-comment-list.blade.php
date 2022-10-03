@if(count((array)$comments))
    @foreach(collect($comments)->sortByDesc('id') as $comment)
        @if(count((array)$comment->replies))
            <div class="card w-75 mt-2" id="comment-{{ $comment->id }}">
                <div class="card-body" id="commentBody">
                    <p class="card-text" id="comment-text-{{ $comment->id }}">{{ $comment->comment }}</p>
                    <small class="text-muted">{{ $comment->user->username }}</small>
                    <small class="text-muted">{{ date('d F Y G:i', strtotime($comment->created_at)) }}</small>
                    <input type="hidden" value="{{ $comment->post_id }}" id="post_id">
                    @if(Auth::user()->id === $comment->user_id  || Auth::user()->isAdmin())
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                data-bs-target="#addReply"
                                data-url="{{ route('reply.add') }}" onclick="getId({{ $comment->id }})"
                                id="addReply-{{ $comment->id }}">{{ __('dashboard.reply') }}</button>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                data-bs-target="#editComm" onclick="getId({{ $comment->id }})"
                                data-url="{{ route('comment.editComment') }}"
                                id="editComm-{{ $comment->id }}">{{ __('dashboard.edit-button') }}</button>
                        <button type="button" class="btn btn-danger"
                                onclick="deleteComment({{ $comment->id }})"
                                id="deleteComm-{{ $comment->id }}"
                                data-url="{{ route('comment.destroy', $comment->id) }}">{{ __('dashboard.delete-button') }}</button>
                    @endif
                    <div class="container g-3" id="commentsReplyContainer-{{ $comment->id }}">
                        @include('child-comment-list',['comments'=>$comment->replies])
                    </div>
                </div>

            </div>

        @endif
    @endforeach
@endif
