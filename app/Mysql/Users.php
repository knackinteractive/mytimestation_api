<?php

namespace App\Mysql;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id [TYPE=INTEGER, NULLABLE=0, DEFAULT=""]
 * @property string $name [TYPE=STRING, NULLABLE=0, DEFAULT=""]
 * @property string $email [TYPE=STRING, NULLABLE=0, DEFAULT=""]
 * @property string $password [TYPE=STRING, NULLABLE=0, DEFAULT=""]
 * @property string $remember_token [TYPE=STRING, NULLABLE=1, DEFAULT=""]
 * @property string $created_at [TYPE=DATETIME, NULLABLE=1, DEFAULT=""]
 * @property string $updated_at [TYPE=DATETIME, NULLABLE=1, DEFAULT=""]
 */
class Users extends Model
{
	// Attributes.
	public $timestamps = false;
	protected $connection = 'mysql';
	protected $table = 'users';
	protected $fillable = ['id', 'name', 'email', 'password', 'remember_token', 'created_at', 'updated_at'];
	protected $guarded = [];
	
	/* ---- Everything after this line will be preserved. ---- */
}
