<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandStoreRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $brands = Brand::all();
        if($brands->has('search'))
        {
            $brands = Brand::where('name','like',"%{$request->search}%")->get();
        }
        return view('admin.brands.index',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandStoreRequest $request)
    {
        $brands = new Brand;

        $brands['name'] = $request->name;
        $brands['desc']=$request->desc;

        $path = Storage::disk('public')->put('/admin/brand',$request->file('image'));

        $brands['image'] = $path;
        $brands['status']= $request->status;
        $brands->save();

        return redirect()->route('brands.index')->with('message','Create Brand Successfully');
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
    public function edit(Brand $brand)
    {
        return view('admin.brands.edit',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandStoreRequest $request, Brand $brand)
    {
        $brand['name'] = $request->name;
        $brand['desc']=$request->desc;

        if($oldImage = $brand->image){
            Storage::disk('public')->delete($oldImage);
            $path = Storage::disk('public')->put('/admin/brand',$request->file('image'));
            $brand['image'] = $path;
        }
        $brand['status']= $request->status;
        $brand->save();

        return redirect()->route('brands.index')->with('message','Create Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Brand $brand)
    {
        if($oldImage = $brand->image){
            Storage::disk('public')->delete($oldImage);
        }
        $brand->delete();
        return redirect()->route('brands.index')->with('message','Create Delete Successfully');
    }

    public function active($brand_id)
    {
        $brand = Brand::find($brand_id);
        $brand->status = 1;
        $brand->save();
        Session::put('message','Kích Hoạt Danh Mục Nhãn Hàng Thành Công');
        return redirect()->back();
    }

    public function unactive($brand_id)
    {
        $brand = Brand::find($brand_id);
        $brand->status = 0;
        $brand->save();
        Session::put('message','Hủy Kích Hoạt Danh Mục Nhãn Hàng Thành Công');
        return redirect()->back();
    }
}
