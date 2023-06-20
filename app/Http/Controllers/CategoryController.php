<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        if($request->has('search')){
            $categories = Category::where('name','like',"%{$request->search}%")->get();
        }
        return view('admin.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryStoreRequest $request)
    {

        $path = Storage::disk('public')->put('/admin/category',$request->file('image'));
        
        $category = new Category;
        $category['name']= $request->name;
        $category['desc']= $request->desc;
        $category['image'] = $path;
        $category['status'] = $request->status;
        $category->save();

        return redirect()->route('categories.index')->with('message','Category Create Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryStoreRequest $request, Category $category)
    {
        
        $category['name']= $request->name;
        $category['desc']= $request->desc;
        
        
        if($oldImage = $category->image)
        {
            Storage::disk('public')->delete($oldImage);
            $path = Storage::disk('public')->put('/admin/category',$request->file('image'));
            $category['image'] = $path;
        }
        
        $category['status']= $request->status;
        $category->save();

        return redirect()->route('categories.index')->with('message','Category Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if($oldImage = $category->image)
        {
            Storage::disk('public')->delete($oldImage);
        }
        $category->delete();
        return redirect()->route('categories.index')->with('message','Category Delete Successfully');
    }

    public function active($category_id)
    {
        $category = Category::find($category_id);
        $category->status = 1;
        $category->save();
        Session::put('message','Kích Hoạt Danh Mục Loại Sản Phẩm Thành Công');
        return redirect()->back();
    }

    public function unactive($category_id)
    {
        $category = Category::find($category_id);
        $category->status = 0;
        $category->save();
        Session::put('message','Hủy Kích Hoạt Danh Mục Loại Sản Phẩm Thành Công');
        return redirect()->back();
    }

}
