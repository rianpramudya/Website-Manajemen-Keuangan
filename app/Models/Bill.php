<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = ['user_id', 'name', 'amount', 'due_date', 'frequency'];

    // Relasi: Satu tagihan bisa memiliki banyak riwayat pembayaran (transaksi)
    // Ini penting agar fitur pembayaran partial/cicilan bisa berjalan
    public function transactions() {
        return $this->hasMany(Transaction::class);
    }
}