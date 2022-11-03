<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.index', [
            'posts_count' => Post::count(),
            'user_count' => User::count(),
            'comment_count' => Comment::count(),
            'category_count' => Category::count()
        ]);
    }
}
