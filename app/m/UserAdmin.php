<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $user_id [TYPE=INTEGER, NULLABLE=0, DEFAULT=""]
 * @property integer $admin_id [TYPE=INTEGER, NULLABLE=0, DEFAULT=""]
 */
class UserAdmin extends Model
{
	// Attributes.
	public $timestamps = false;
	protected $connection = 'mysql';
	protected $table = 'user_admin';
	protected $fillable = ['user_id', 'admin_id'];
	protected $guarded = [];
	
	/* ---- Everything after this line will be preserved. ---- */
}
