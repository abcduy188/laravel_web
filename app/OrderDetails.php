<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'order_id', 'product_id', 'product_name',
        'product_price', 'product_sales_quantity'
        
    ];
    protected $primarykey = 'order_details_id ';
    protected $table = 'order_detail';
}
