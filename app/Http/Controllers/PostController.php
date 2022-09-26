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
            'text' => 'required|min:1',
            'file' => 'image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $data = $request->all();
        if ($data['locale'] === 'en') {
            $post = Post::create([
                'user_id' => strip_tags($data['user_id']),
                'text_en' => strip_tags($data['text']),
                'image' => $this->storeImage($request),
            ]);
        }
        elseif ($data['locale'] === 'ru') {
            $post = Post::create([
                'user_id' => strip_tags($data['user_id']),
                'text_ru' => strip_tags($data['text'])
            ]);
        }
        elseif ($data['locale'] === 'uk') {
            $post = Post::create([
                'user_id' => strip_tags($data['user_id']),
                'text_uk' => strip_tags($data['text'])
            ]);
        }

        if ($post) {
            if ($data['locale'] === 'en') {
                $text = $post->text_en;
            }
            elseif ($data['locale'] === 'ru') {
                $text = $post->text_ru;
            }
            elseif ($data['locale'] === 'uk') {
                $text = $post->text_uk;
            }
            $responsePostArray = [
                'id' => $post->id,
                'uName' => Auth::user()->username,
                'date' => date('d F Y G:i', strtotime($post->created_at)),
                'text' => $text,
                'image' => $post->image,
            ];
            $html = view('content.post')->with('responsePostArray', $responsePostArray)->renderSections()['postContent'];
            return response()->json(['success' => 'Post created successfully', 'html' => $html]);
        }

        return redirect('dashboard')->with('addPostError', 'Incorrect data');
    }

    public function update(Request $request)
    {
        $request->validate([
            'editPostText' => 'required|min:1'
        ]);
        $data = $request->all();
        if ($data['locale'] === 'en') {
            $post = Post::where('id', $data['editPostId'])->update(['text_en' => $data['editPostText']]);
        }
        elseif ($data['locale'] === 'ru') {
            $post = Post::where('id', $data['editPostId'])->update(['text_ru' => $data['editPostText']]);
        }if ($data['locale'] === 'uk') {
            $post = Post::where('id', $data['editPostId'])->update(['text_uk' => $data['editPostText']]);
        }
        return response()->json(['success', __('dashboard.updatedSuccessfully'), 'text' => $data['editPostText']]);
    }

    public function destroy($id)
    {
        Post::where('id', $id)->delete();
        return response()->json(['success', __('dashboard.postDeletedCompletely')]);
    }

    private function storeImage(Request $request)
    {
        $newImageName = uniqid() . '-photo' . '.' . $request->file->extension();
        return $request->file->move('images/', $newImageName);
    }


}
