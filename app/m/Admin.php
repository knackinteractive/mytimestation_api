<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id [TYPE=INTEGER, NULLABLE=0, DEFAULT=""]
 * @property string $name [TYPE=STRING, NULLABLE=0, DEFAULT=""]
 * @property string $email [TYPE=STRING, NULLABLE=0, DEFAULT=""]
 * @property integer $specific_dept_access_id [TYPE=INTEGER, NULLABLE=1, DEFAULT=""]
 * @property boolean $permission_type [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property boolean $is_authorize_ts_devices [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property boolean $is_create_edit_administrators [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property boolean $is_create_edit_departments [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property boolean $is_create_edit_employees [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property boolean $is_create_time_entries [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property boolean $is_edit_company_settings [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property boolean $is_edit_time_entries [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property boolean $is_manage_billing_plan [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property boolean $is_print_employee_cards [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property boolean $is_run_reports [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property boolean $is_view_gps_location_info [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property boolean $is_view_pay_info [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property integer $dept_access_type [TYPE=INTEGER, NULLABLE=1, DEFAULT=""]
 */
class Admin extends Model
{
	// Attributes.
	public $timestamps = false;
	protected $connection = 'mysql';
	protected $table = 'admin';
	protected $fillable = [
		'id', 'name', 'email', 'specific_dept_access_id', 'permission_type', 'is_authorize_ts_devices',
		'is_create_edit_administrators', 'is_create_edit_departments', 'is_create_edit_employees',
		'is_create_time_entries', 'is_edit_company_settings', 'is_edit_time_entries', 'is_manage_billing_plan',
		'is_print_employee_cards', 'is_run_reports', 'is_view_gps_location_info', 'is_view_pay_info',
		'dept_access_type'
	];
	protected $guarded = [];
	
	/* ---- Everything after this line will be preserved. ---- */
}
