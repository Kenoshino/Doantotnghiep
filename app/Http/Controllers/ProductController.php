<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = Product::all();
        if($request->has('search'))
        {
            $products = Product::where('name','like',"%$request->search%")->get();
        }
        return view('admin.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.create',compact('categories'),compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        $path = Storage::disk('public')->put('/admin/product',$request->file('image'));
        
        $products = new Product();
        $products['name']= $request->name;
        $products['category_id']= $request->category_id;
        $products['brand_id']= $request->brand_id;
        $products['desc']= $request->desc;
        $products['image'] = $path;
        $products['quantity']= $request->quantity;
        $products['in_price']= $request->in_price;
        $products['out_price']= $request->out_price;
        $products['status'] = $request->status;
        $products->save();

        return redirect()->route('products.index')->with('message','Product Create Successfully');

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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function active($product_id)
    {
        $product = Category::find($product_id);
        $product->status = 1;
        $product->save();
        Session::put('message','Kích Hoạt Danh Mục Sản Phẩm Thành Công');
        return redirect()->back();
    }

    public function unactive($product_id)
    {
        $product = Category::find($product_id);
        $product->status = 0;
        $product->save();
        Session::put('message','Hủy Kích Hoạt Danh MụcSản Phẩm Thành Công');
        return redirect()->back();
    }

}
