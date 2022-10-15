<?php

namespace App\Http\Controllers;

use App\Models\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->paginate(10);
        if ($key = request()->key) {
            $categories = Category::orderBy('id', 'DESC')->where('name', 'like', '%' . $key . '%')->paginate(10);
        }

        return view('admin.category.list', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
            'name' => 'required'
        ], [
            'name.required' => 'Vui Lòng Nhập Tên Danh Mục!'
        ]);
        Category::create(['name' => $request->name]);
        return redirect()->route('ad.category.index')->with('success', 'Thêm Mới Danh Mục Thành Công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cat = Category::find($id);
        return view('admin.category.edit', compact('cat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ], [
            'name.required' => 'Vui Lòng Nhập Tên Danh Mục!'
        ]);

        Category::where('id', $id)->update(['name' => $request->name]);
        return redirect()->route('ad.category.edit', $id)->with('success', 'Cập Nhật Danh Mục Thành Công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        Category::where('id', $id)->delete();
        return redirect()->route('ad.category.index')->with('success', 'Xóa Danh Mục Thành Công!');
    }
}