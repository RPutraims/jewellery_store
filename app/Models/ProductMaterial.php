<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductMaterial;
use App\Models\Product;

class ProductMaterial extends Model
{
    protected $table = 'productmaterial';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'material_id'
    ];

    public function material()
    {
        return $this->belongsToMany(Material::class);
    }

    public function product()
    {
        return $this->belongsToMany(Product::class);
    }

}
