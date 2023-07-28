<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payment';

    protected $fillable = [
        'kd_pesanan',
        'nominal_payment',
        'kembalian_payment'
    ];

    use HasFactory;

    public function pesanan(): BelongsTo {
        return $this->belongsTo(Pesanan::class, 'kd_pesanan', 'kd_pesanan');
    }
}
