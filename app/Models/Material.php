<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Material extends Model
{
    protected $table = 'material';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'material_name',
        'material_description',
        'price_increment'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
