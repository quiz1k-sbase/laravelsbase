<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $dataPost = Post::join('users', 'user_id', '=', 'users.id')->get(['posts.*', 'users.username'])->sortByDesc('id');
        $dataComment= Comment::join('users', 'user_id', '=', 'users.id')->get(['comments.*', 'users.username'])->sortByDesc('id');
        return view('dashboard', compact('dataPost', 'dataComment'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'text' => 'required|min:1'
        ]);

        $data = $request->all();
        $post = Post::create([
           'user_id' => strip_tags($data['user_id']),
           'text' => strip_tags($data['text'])
        ]);

        if ($post)
        {
            return response()->json(['success' => 'Post created successfully.', 'uName' => Auth::user()->username,
                'id' => $post->id, 'date' => date('d F Y G:i', strtotime($post->created_at))]);
        }

        return redirect('dashboard')->with('addPostError', 'Incorrect data');
    }

    public function update(Request $request)
    {
        $request->validate([
            'editPostText' => 'required|min:1'
        ]);
        $data = $request->all();
        $post = Post::where('id', $data['editPostId'])->update(['text' => $data['editPostText']]);
        return response()->json(['success', __('dashboard.updatedSuccessfully'), 'text' => $data['editPostText']]);
    }

    public function destroy($id)
    {
        Post::where('id', $id)->delete();
        return response()->json(['success', __('dashboard.postDeletedCompletely')]);
    }


}
