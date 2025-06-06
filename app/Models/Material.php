<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductMaterial;

class Material extends Model
{
    protected $table = 'material';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'material_name',
        'material_description',
        'price_increment'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'productmaterial', 'material_id', 'product_id');
    }

}
