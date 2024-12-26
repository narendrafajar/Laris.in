<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterCompany extends Model
{
    use HasFactory;
    protected $table = 'master_type_company';
    protected $primaryKey = 'id';
    protected $fillable = [
        'company_name',
        'company_code',
    ];
}
