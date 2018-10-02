<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $email [TYPE=STRING, NULLABLE=0, DEFAULT=""]
 * @property string $token [TYPE=STRING, NULLABLE=0, DEFAULT=""]
 * @property string $created_at [TYPE=DATETIME, NULLABLE=1, DEFAULT=""]
 */
class PasswordResets extends Model
{
	// Attributes.
	public $timestamps = false;
	protected $connection = 'mysql';
	protected $table = 'password_resets';
	protected $fillable = ['email', 'token', 'created_at'];
	protected $guarded = [];
	
	/* ---- Everything after this line will be preserved. ---- */
}
