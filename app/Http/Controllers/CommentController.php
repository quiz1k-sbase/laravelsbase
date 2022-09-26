<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'post_id' => 'required',
            'comment' => 'required|min:1'
        ]);

        $data = $request->all();
        $comm = Comment::create([
            'user_id' => strip_tags($data['user_id']),
            'post_id' => strip_tags($data['post_id']),
            'comment' => strip_tags($data['comment'])
        ]);

        if ($comm)
        {
            /*return response()->json(['success' => 'Post created successfully.', 'uName' => Auth::user()->username,
                'id' => $comm->id, 'date' => date('d F Y G:i', strtotime($comm->created_at))]);*/
            $responseCommentArray = [
                'id' => $comm->id,
                'uName' => Auth::user()->username,
                'date' => date('d F Y G:i', strtotime($comm->created_at)),
                'comment' => $comm->comment
            ];
            $html = view('content.comment')->with('responseCommentArray', $responseCommentArray)
                ->renderSections()['commentContent'];
            return response()->json(['success' => 'Post created successfully.', 'html' => $html]);
        }

        return redirect('dashboard')->with('addCommentError', __('dashboard.incorrectData'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'editCommentText' => 'required|min:1'
        ]);
        $data = $request->all();
        $comm = Comment::where('id', $data['editCommentId'])->update(['comment' => $data['editCommentText']]);
        return response()->json(['success', __('dashboard.updatedSuccessfully'), 'text' => $data['editCommentText']]);
    }

    public function destroy($id)
    {
        Comment::where('id', $id)->delete();
        return response()->json(['success', __('dashboard.commentDeletedCompletely')]);
    }
}
