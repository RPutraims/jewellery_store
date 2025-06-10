<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\ProductMaterial;
use App\Models\Material;
use App\Models\ProductSize;
use App\Models\Size;

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

    public function materials()
    {
        return $this->belongsToMany(Material::class, 'productmaterial', 'product_id', 'material_id');
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'productsize', 'product_id', 'size_id');
    }

}
