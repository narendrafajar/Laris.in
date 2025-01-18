<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailConsignorSale extends Model
{
    use HasFactory;
    protected $table = 'detail_consignor';
    protected $primaryKey = 'id';
    protected $fillable = [
        'consignor_id',
        'product_id',
        'qty',
        'sold',
        'remaining',
        'price',
        'subtotal',
    ];

    public function consignors()
    {
        return $this->belongsTo(ConsignorSale::class,'consignor_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
