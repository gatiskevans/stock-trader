<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $table = 'user_stocks';

    protected $fillable = [
        'company',
        'stock',
        'quantity'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
