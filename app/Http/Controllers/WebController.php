<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class WebController extends Controller
{
    public function home()
    {
        $categories = Category::orderBy('id', 'DESC')->take(5)->get();

        $posts = Post::orderBy('id', 'DESC')->paginate(10);
        if ($key = request()->key) {
            $posts = Post::orderBy('id', 'DESC')->where('title', 'like', '%' . $key . '%')->paginate(10);
        }

        return view('web.home', compact('categories', 'posts'));
    }

    public function post($id)
    {
        $categories = Category::orderBy('id', 'DESC')->take(5)->get();

        $post = Post::where('id', $id)->first();

        $relate = Post::where('category_id', $post->category_id)->whereNotIn('id', [$id])->take(3)->orderBy('id', 'ASC')->get();

        return view('web.post', compact('post', 'categories', 'relate'));
    }

    public function category($id)
    {
        $categories = Category::orderBy('id', 'DESC')->take(5)->get();

        $cate = Category::where('id', $id)->first();
        $cate_posts = Post::where('category_id', $cate->id)->paginate(10);

        return view('web.category', compact('cate_posts', 'categories', 'cate'));
    }

    public function search()
    {
        if (isset($_GET['key'])) {
            $key = $_GET['key'];

            $categories = Category::orderBy('id', 'DESC')->take(5)->get();

            if ($key = request()->key) {
                $posts = Post::orderBy('id', 'DESC')->where('title', 'like', '%' . $key . '%')->orWhere('sumary', 'like', '%' . $key . '%')->paginate(10);
            }
            return view('web.search', compact('categories', 'posts', 'key'));
        }
    }
}