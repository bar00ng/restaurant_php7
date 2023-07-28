<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use App\Models\Payment;

class Pesanan extends Model
{
    protected $table = 'pesanan';

    // protected $primaryKey = 'kd_pesanan';

    protected $fillable = [
        'kd_pesanan',
        'pemesan_pesanan',
        'total_pesanan',
        'user_id',
        'tanggal_pesanan',
        'status'
    ];

    use HasFactory;

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function payment(): HasOne {
        return $this->hasOne(Payment::class, 'kd_pesanan', 'kd_pesanan');
    }

    public function detailPesanan(): HasMany {
        return $this->hasMany(PesananDetail::class, 'kd_pesanan', 'kd_pesanan');
    }
    
    public static function generateKodePesanan() {
        $format = 'KD_%04d_%s';

        do {
            $randomNumber = mt_rand(1, 1000);
            $kodePesanan = sprintf($format, $randomNumber, date('dmy'));
        } while (self::where('kd_pesanan', $kodePesanan)->exists());

        return $kodePesanan;
    }
}
