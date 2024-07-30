<?php

namespace App\Http\Controllers;
use App\Models\Category;

use Illuminate\Http\Request;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::all();
        return view('category.index',compact('category'));
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
            'catname' => 'required|string',
            'status' => 'required|string',
          ]);
  
        $input = $request->all();
        Category::create($input);
        return redirect('category')->with('success', 'category insert successfully.');
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
         $categorys = Category::find($id);
         return view("category.edit",compact('categorys'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = $request->validate([
            'catname' => 'required|string',
            'status' => 'required|string',
          ]);
        $categorys = Category::find($id);
        $categorys->update($request->all());
        return redirect('category')->with('success', 'category update successfully.');
  
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request ,string $id)
    {
        $categorys = Category::find($id);
        $categorys->destroy($id);
        return redirect('category')->with('success', 'category delete successfully.');
    }
}
