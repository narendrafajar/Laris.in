<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'master_product';
    protected $primaryKey = 'id';
    protected $fillable = [
        'product_company_id',
        'product_code',
        'product_name',
        'product_vol',
        'product_price',
        'product_sale_price',
        'product_stats',
    ];

    public function company()
    {
        return $this->belongsTo(MasterCompany::class,'product_company_id');
    }
}
