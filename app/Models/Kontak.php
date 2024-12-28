<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    use HasFactory;
    protected $table = 'contact';
    protected $primaryKey = 'id';
    protected $fillable = [
        'contact_code',
        'contact_store_name',
        'contact_name',
        'contact_pic_name',
        'contact_address',
        'contact_number_1',
        'contact_number_2',
        'lattitude',
        'longitude',
    ];
}
