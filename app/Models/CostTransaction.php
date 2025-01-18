<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostTransaction extends Model
{
    use HasFactory;
    protected $table = 'cost_transaction';
    protected $primaryKey = 'id';
    protected $fillable = [
        'cost_code',
        'cost_date',
        'vendor_name',
        'cost_total_amount',
    ];
}
