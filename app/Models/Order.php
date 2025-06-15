<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Order extends Model
{
    use HasFactory;

    protected $table = 'Order';

    protected $fillable = [
        'stripe_session_id',
        'user_id',
        'total',
        'delivery',
        'address',
        'payment_type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
