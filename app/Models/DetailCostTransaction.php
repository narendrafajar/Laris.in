<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailCostTransaction extends Model
{
    use HasFactory;
    protected $table = 'detail_cost_transaction';
    protected $primaryKey = 'id';
    protected $fillable = [
        'cost_id',
        'items_name',
        'items_type',
        'items_amount',
        'items_volume',
        'items_price',
    ];

    public function cost()
    {
        return $this->belongsTo(CostTransaction::class,'cost_id');
    }
}
