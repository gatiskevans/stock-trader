<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'users_stocks_transactions';

    protected $fillable = [
        'stock_name',
        'quantity',
        'total_amount',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
