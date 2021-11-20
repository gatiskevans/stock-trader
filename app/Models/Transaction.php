<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static where(string $string, $id)
 */
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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
