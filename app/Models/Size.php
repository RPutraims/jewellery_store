<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductSize;

class Size extends Model
{
    protected $table = 'size';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'size_value',
        'price_increment'
    ];

    public function productsize()
    {
        return $this->hasMany(ProductSize::class); // or hasMany(), if there can be multiple
    }
}
