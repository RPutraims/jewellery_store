<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

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

    public function productmaterial()
    {
        return $this->hasMany(ProductMaterial::class); // or hasMany(), if there can be multiple
    }

    public function productsize()
    {
        return $this->hasMany(ProductSize::class); // or hasMany(), if there can be multiple
    }

}
