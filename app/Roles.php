<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
    	'role'
    ];
    protected $primaryKey = 'id';
 	protected $table = 'role';

 	public function members(){
 		return $this->belongsToMany('App\Member');
 	}
}
