<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\Size;

class ProductSize extends Model
{
    protected $table = 'productsize';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'size_id'
    ];

    public function size()
    {
        return $this->belongsToMany(Size::class);
    }

    public function product()
    {
        return $this->belongsToMany(Product::class);
    }
}
