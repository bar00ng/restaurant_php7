<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';

    protected $fillable = [
        'data_pesanan',
        'total_pesanan',
        'user_id',
        'tanggal_pesanan',
        'status'
    ];

    use HasFactory;
}
