<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;


class DashboardController extends Controller
{
    public function index()
    {
        $totalPosts = Blog::count(); // Count total blog posts
        $totalCategories = Category::count(); // Count total categories
        $postsLastWeek = Blog::where('created_at', '>=', Carbon::now()->subDays(7))->count();
        $postsLastMonth = Blog::where('created_at', '>=', Carbon::now()->subMonth())->count();
        $postsLastYear = Blog::where('created_at', '>=', Carbon::now()->subYear())->count();

        return view('dashboard', compact('totalPosts', 'totalCategories', 'postsLastWeek', 'postsLastMonth', 'postsLastYear'));
    }
}
