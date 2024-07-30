<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Saledetail;

class Products extends Model
{
    protected $table = 'products';
    protected $fillable = ['productname','price','cat_id','brand_id'];


    public function category(){
        return $this->belongsTo(Category::class , 'cat_id');
    }

    public function brand(){
        return $this->belongsTo(Brand::class , 'brand_id');
    }

    public function saleDetails(){
        return $this->hasMany(Saledetail::class);
    }



    use HasFactory;
}
