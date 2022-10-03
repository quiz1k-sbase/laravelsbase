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
            return view('graph.graphs');
        } else {
            return redirect('dashboard')->with('success', 'You are not Admin');
        }
    }

    public function getDate(Request $request)
    {
        $data = $request->all();
        //$createdPosts = Post::select(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as day, COUNT(id) as post_count'))->groupBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'))->get();
        $createdPosts = Post::select(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as day, COUNT(id) as post_count'))->where('created_at', '>=', $data['dateFrom'])->where('created_at', '<=', $data['dateTo'])->groupBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'))->get();

        $createdComments = Comment::select(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as day, COUNT(id) as comment_count'))->where('created_at', '>=', $data['dateFrom'])->where('created_at', '<=', $data['dateTo'])->groupBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'))->get();

        $createdUsers = User::select(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d") as day, COUNT(id) as user_count'))->where('created_at', '>=', $data['dateFrom'])->where('created_at', '<=', $data['dateTo'])->groupBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m-%d")'))->get();

        $date = $request->all();

        return response()->json(['date' => $date, 'posts' => $createdPosts, 'comments' => $createdComments, 'users' => $createdUsers]);
    }
}
