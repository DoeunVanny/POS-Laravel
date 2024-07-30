<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Saledetail;

class Sale extends Model
{
    protected $table = 'sales';
    protected $fillable = ['total','pay','balance'];

    public function saleDetails(){
        return $this->hasMany(Saledetail::class , 'sale_id');
    }
    use HasFactory;
}
