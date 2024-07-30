<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sale;
use App\Models\Products;

class Saledetail extends Model
{
    protected $table = 'saledetails';
    protected $fillable = ['sale_id','product_id','price','qty','total_cost'];

    public function sale(){
        return $this->belongsTo(Sale::class,'sale_id');
    }
    public function product(){
        return $this->belongsTo(Products::class);
    }

    use HasFactory;
}
