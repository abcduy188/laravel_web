<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
	use Notifiable;
	public $timestamps = false; 
	protected $fillable = [
		'email', 'password', 'Status', 'Name', 'IsDelete', 'CreateBy', 'CreateDate', 'ModifiedBy', 'ModifiedDate', 'Phone','code'
	];
	protected $primaryKey = 'id';
	protected $table = 'user';

	public function roles()
	{
		return $this->belongsToMany('App\Roles');
	}

	public function getAuthPassword()
	{
		return $this->password;
	}
	public function hasAnyRoles($role)
	{
		return null !== $this->roles()->whereIn('role', $role)->first();
	}
	public function hasRole($role)
	{
		return null !== $this->roles()->where('role', $role)->first();
	}
}
