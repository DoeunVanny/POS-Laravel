<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Products;

class Brand extends Model
{
    protected $table = 'brands';
    protected $fillable = ['brandname','status'];

    public function products(){
        return $this->hasMany(Products::class , 'brand_id');
    }

    use HasFactory;
}
