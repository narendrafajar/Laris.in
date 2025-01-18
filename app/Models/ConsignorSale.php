<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConsignorSale extends Model
{
    use HasFactory;
    protected $table = 'consignors_sale';
    protected $primaryKey = 'id';
    protected $fillable = [
        'consignor_code',
        'contact_id',
        'consignor_date_store',
        'consignor_date_pickup',
        'consignor_item_total',
        'consignor_total_amount',
        'consignor_stats',
    ];

    public function kontak()
    {
        return $this->belongsTo(Kontak::class,'contact_id');
    }

    public function detailConsignor()
    {
        return $this->hasMany(DetailConsignorSale::class,'consignor_id','id');
    }
}
