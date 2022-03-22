<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'customer_id', 'order_status', 'CreateDate', 'order_code',
        'shipping_name', 'shipping_address', 'order_note',
        'shipping_phone', 'shipping_email', 'shipping_type'
    ];
    protected $primarykey = 'order_id';
    protected $table = 'tbl_order';
}
