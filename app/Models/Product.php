<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'sale_price',
        'photo'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
