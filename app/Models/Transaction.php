<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    // Update fillable agar bill_id bisa diisi
    protected $fillable = ['user_id', 'category_id', 'bill_id', 'description', 'amount', 'type', 'date'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    // Relasi ke Tagihan
    public function bill() {
        return $this->belongsTo(Bill::class);
    }
}