<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $emp_id [TYPE=INTEGER, NULLABLE=0, DEFAULT=""]
 * @property integer $dept_id [TYPE=INTEGER, NULLABLE=0, DEFAULT=""]
 * @property boolean $is_primary [TYPE=BOOLEAN, NULLABLE=0, DEFAULT=""]
 */
class EmpDept extends Model
{
	// Attributes.
	public $timestamps = false;
	protected $connection = 'mysql';
	protected $table = 'employee_secondary_depts';
	protected $fillable = ['emp_id', 'dept_id', 'is_primary'];
	protected $guarded = [];
	
	/* ---- Everything after this line will be preserved. ---- */
}
