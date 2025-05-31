<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'sale_price',
        'photo'
    ];


    // In app/Models/Product.php
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
