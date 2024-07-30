<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Products::all();
        $brands  = Brand::pluck('brandname','id');
        $categorys  = Category::pluck('catname','id');
        return view('product.index',compact('product','brands' ,'categorys'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'productname' => 'required|string',
            'price' => 'required',
            'cat_id' => 'required',
            'brand_id' => 'required',
          ]);
        Products::create($request->all());
        return redirect('product')->with('success','Product insert successfuly');
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $products , $id)
    {
        
          $products = Products::find($id);
          $brands  = Brand::pluck('brandname','id');
          $categorys  = Category::pluck('catname','id');
        return view('product.edit',compact('products','brands','categorys'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $products, $id)
    {
        $validateData = $request->validate([
            'productname' => 'required|string',
            'price' => 'required',
            'cat_id' => 'required',
            'brand_id' => 'required',
          ]);
        $products = Products::find($id);
        $products->update($request->all());
        return redirect('product')->with('success','Product update successfuly');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $products)
    {
        $products = Products::find($id);
        $products->delete();
        return redirect('product')->with('success','Product delete successfuly');
    }
}
