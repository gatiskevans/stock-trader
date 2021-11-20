<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static where(string $string, $id)
 */
class Stock extends Model
{
    use HasFactory;

    protected $table = 'user_stocks';

    protected $fillable = [
        'company',
        'stock',
        'quantity'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
