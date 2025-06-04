<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Product;


class Category extends Model
{
    protected $table = 'category';

    protected $fillable = [
        'category_name',
        'category_description',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
