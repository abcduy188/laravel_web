<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'Name', 'SeoTitle', 'Description', 'Image', 'Price', 'PromotionPrice', 'Quantity', 'Status', 'IsDelete','CreateDate','ModifiedDate','CreateBy','ModifiedBy', 'category_id'
    ];
    protected $primarykey = 'id';
    protected $table = 'product';
    public function category()
    {
        return $this->belongsTo('App\CategoryProduct');
    }
}
