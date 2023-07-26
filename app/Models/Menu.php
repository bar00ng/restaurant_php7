<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Kategori;

class Menu extends Model
{
    protected $table = 'menu';

    protected $fillable = [
        'nama_menu',
        'harga_modal_menu',
        'harga_jual_menu',
        'kategori_id',
        'inStock',
    ];

    public function kategori(): HasOne {
        return $this->hasOne(Kategori::class, 'id', 'kategori_id');
    }

    use HasFactory;
}
