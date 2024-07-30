<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Sale;
use App\Models\Saledetail;
use Illuminate\Support\Facades\DB;

class salesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('sale.create');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function search(Request $request)
    {
        $query = $request->input('barcode');
        $products = Products::where('id','like' ,'%' . $query . '%')->get();
        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        try{
            $lastId = null;
            DB::transaction(function () use ($request , &$lastId){
                    $sales = Sale::create([
                        'total' => $request->input('total'),
                        'pay' => $request->input('pay'),
                        'balance' => $request->input('balance'),
                    ]);
                   $lastId = $sales->id;
            foreach($request->input('products') as $products){
                Saledetail::create([
                      'sale_id' => $sales->id,
                      'product_id' => $products['barcode'],
                      'price' => $products['pro_price'],
                      'qty' => $products['qty'],
                      'total_cost' => $products['total'], 
                ]);
            }

        });
        return response()->json([
            'message' => 'Sale added successfuly',
            'last_id' => $lastId
        ]);
        }catch(Exception $e){
            return response()->json(['message' => 'Sale added error'],500);
        }
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
}
