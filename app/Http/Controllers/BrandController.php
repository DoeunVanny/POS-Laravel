<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brand = Brand::all(); 
        return view('brand.index',compact('brand'));
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
            'brandname' => 'required|string',
            'status' => 'required|string',
          ]);
        Brand::create($request->all());
        return redirect('brand')->with('success', 'Brand insert successfully.');;
    }

    /**
     * Display the specified resource.
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $brands = Brand::find($id);
        return view('brand.edit',compact('brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'brandname' => 'required|string',
            'status' => 'required|string',
          ]);
        $brands = Brand::find($id);
        $brands->update($request->all());
        return redirect('brand')->with('success', 'Brand update successfully.');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $brands = Brand::find($id);
        $brands->delete();
        return redirect('brand')->with('success', 'Brand delete successfully.');;
    }
}
