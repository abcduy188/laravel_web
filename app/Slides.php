<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slides extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'slide_name','slide_image','status','slide_desc'
    ];
    protected $primaryKey = 'id';
 	protected $table = 'slides';
}
