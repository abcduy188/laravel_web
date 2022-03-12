<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'CategoryName', 'CreateBy', 'CreateDate', 'IsDelete', 'ModifiedBy', 'ModifiedDate', 'ParentID', 'SeoTitle', 'Status'
    ];
    protected $primarykey = 'id';
    protected $table = 'categoryproduct';
    public function products()
    {
        return $this->hasMany('App\Product','category_id');
    }
}
