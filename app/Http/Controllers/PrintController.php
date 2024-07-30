<?php

namespace App\Http\Controllers;
use App\Models\Sale;
use App\Models\Saledetial;

use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function showPrintForm($sales_id){
        $sales = Sale::findOrFail($sales_id);

        $saleDetails = $sales->saleDetails;
        $total = $sales->total;

        $grand_total = $total;
        $pay = $sales->pay;
        $balance = $sales->balance;

        return view('sale.print',compact('sales','sales_id','saleDetails','total','grand_total','pay','balance'));
    }
}
