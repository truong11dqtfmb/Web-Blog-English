<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $posts = Post::orderBy('id', 'DESC')->paginate(10);
        if ($key = request()->key) {
            $posts = Post::orderBy('id', 'DESC')->where('title', 'like', '%' . $key . '%')->paginate(10);
        }

        return view('admin.post.list', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.post.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'sumary' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'image' => 'required'

        ], [
            'title.required' => 'Vui Lòng Nhập Tiêu Đề Bài Viết!',
            'sumary.required' => 'Vui Lòng Nhập Tóm Tắt Bài Viết!',
            'content.required' => 'Vui Lòng Nhập Nội Dung Bài Viết!',
            'category_id.required' => 'Vui Lòng Chọn Danh Mục!',
            'image.required' => 'Vui Lòng Chọn Ảnh!'
        ]);

        if ($request->has('image')) {
            $file = $request->image;
            $ext = $file->getClientOriginalExtension();
            // dd($file);
            // $file_name = $file->getClientOriginalName();
            $image = time() . '_' . 'post' . '.' . $ext;
            // dd($image);
            // dd($file_name);
            $file->move(public_path('uploads'), $image);
        }

        // $request->merge(['image' => $image]);

        // echo ('success');


        Post::create([
            'title' => $request->title,
            'sumary' => $request->sumary,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'image' => $image,
        ]);
        return redirect()->route('ad.post.index')->with('success', 'Thêm Mới Bài Viết Thành Công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        return view('admin.post.show', compact('post', 'categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();
        return view('admin.post.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'sumary' => 'required',
            'content' => 'required',
            'category_id' => 'required',

        ], [
            'title.required' => 'Vui Lòng Nhập Tiêu Đề Bài Viết!',
            'sumary.required' => 'Vui Lòng Nhập Tóm Tắt Bài Viết!',
            'content.required' => 'Vui Lòng Nhập Nội Dung Bài Viết!',
            'category_id.required' => 'Vui Lòng Chọn Danh Mục!',
        ]);

        if ($request->has('image')) {
            $file = $request->image;
            $ext = $file->getClientOriginalExtension();
            // dd($file);
            // $file_name = $file->getClientOriginalName();
            $image = time() . '_' . 'post' . '.' . $ext;
            // dd($image);
            // dd($file_name);
            $file->move(public_path('uploads'), $image);
        }

        // $request->merge(['image' => $image]);

        // echo ('success');

        $post = Post::find($id);
        $post->update([
            'title' => $request->title,
            'sumary' => $request->sumary,
            'content' => $request->content,
            'category_id' => $request->category_id,
            'image' => isset($image) ? $image : $post->image
        ]);
        return redirect()->route('ad.post.edit', $id)->with('success', 'Cập Nhật Bài Viết Thành Công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        Post::where('id', $id)->delete();
        return redirect()->route('ad.post.index')->with('success', 'Xóa Bài Viết Thành Công!');
    }
}