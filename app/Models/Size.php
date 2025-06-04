<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Size extends Model
{
    protected $table = 'size';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'size_value',
        'price_increment'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
