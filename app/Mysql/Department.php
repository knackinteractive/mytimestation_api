<?php

namespace App\Mysql;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id [TYPE=INTEGER, NULLABLE=0, DEFAULT=""]
 * @property string $name [TYPE=STRING, NULLABLE=0, DEFAULT=""]
 * @property boolean $type [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property boolean $is_exclude_from_reporting [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property boolean $is_use_company_setting [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property boolean $is_assign_to_all_emp [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property boolean $deduct [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property boolean $hours [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property string $created_at [TYPE=DATETIME, NULLABLE=0, DEFAULT="CURRENT_TIMESTAMP"]
 * @property integer $created_by [TYPE=INTEGER, NULLABLE=1, DEFAULT=""]
 */
class Department extends Model
{
	// Attributes.
	public $timestamps = false;
	protected $connection = 'mysql';
	protected $table = 'department';
	protected $fillable = [
		'id', 'name', 'type', 'is_exclude_from_reporting', 'is_use_company_setting', 'is_assign_to_all_emp',
		'deduct', 'hours', 'created_at', 'created_by'
	];
	protected $guarded = [];
	
	/* ---- Everything after this line will be preserved. ---- */
}
