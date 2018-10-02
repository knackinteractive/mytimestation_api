<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $admin_id [TYPE=INTEGER, NULLABLE=0, DEFAULT=""]
 * @property integer $dept_id [TYPE=INTEGER, NULLABLE=0, DEFAULT=""]
 */
class AdminDeptAccess extends Model
{
	// Attributes.
	public $timestamps = false;
	protected $connection = 'mysql';
	protected $table = 'admin_dept_access';
	protected $fillable = ['admin_id', 'dept_id'];
	protected $guarded = [];
	
	/* ---- Everything after this line will be preserved. ---- */
}
