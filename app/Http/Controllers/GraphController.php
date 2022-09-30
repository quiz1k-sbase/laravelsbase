<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GraphController extends Controller
{
    public function index() {
        if (Auth::check() && Auth::user()->isAdmin()) {

            $createdPosts = Post::select(DB::raw('DAY(created_at) as day, COUNT(id) as post_count'))->groupBy(DB::raw('DAY(created_at)'))->get();
            $posts  = [];
            foreach($createdPosts as $val) {
                $posts += [ $val->day => $val->post_count,
                ];
            }
            $createdPosts = Comment::select(DB::raw('DAY(created_at) as day, COUNT(id) as comment_count'))->groupBy(DB::raw('DAY(created_at)'))->get();
            $comments  = [];
            foreach($createdPosts as $val) {
                $comments += [ $val->day => $val->comment_count,
                ];
            }
            $createdPosts = User::select(DB::raw('DAY(created_at) as day, COUNT(id) as user_count'))->groupBy(DB::raw('DAY(created_at)'))->get();
            $users  = [];
            foreach($createdPosts as $val) {
                $users += [ $val->day => $val->user_count,
                ];
            }
            //dd($created_at);
            return view('graph.graphs', compact('posts', 'comments', 'users'));
        } else {
            return redirect('dashboard')->with('success', 'You are not Admin');
        }
    }
}
