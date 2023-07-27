<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;


class PesananDetail extends Model
{
    protected $table = 'pesanan_detail';

    protected $fillable = [
        'kd_pesanan',
        'menu_id',
        'qty',
        'sub_total'
    ];

    use HasFactory;

    public function pesanan(): BelongsTo {
        return $this->belongsTo(Pesanan::class, 'kd_pesanan', 'kd_pesanan');
    }

    public function menu(): HasOne {
        return $this->hasOne(Menu::class, 'menu_id', 'id');
    }
}
