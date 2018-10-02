<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id [TYPE=INTEGER, NULLABLE=0, DEFAULT=""]
 * @property string $name [TYPE=STRING, NULLABLE=0, DEFAULT=""]
 * @property integer $dept_id [TYPE=INTEGER, NULLABLE=0, DEFAULT=""]
 * @property boolean $is_primary [TYPE=BOOLEAN, NULLABLE=1, DEFAULT="1"]
 * @property integer $emp_id [TYPE=INTEGER, NULLABLE=1, DEFAULT=""]
 * @property string $title [TYPE=STRING, NULLABLE=1, DEFAULT=""]
 * @property boolean $status [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property string $last_activity [TYPE=STRING, NULLABLE=1, DEFAULT=""]
 * @property int $hourly_rate [TYPE=SMALLINT, NULLABLE=1, DEFAULT=""]
 * @property boolean $is_notifications [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property string $email [TYPE=STRING, NULLABLE=1, DEFAULT=""]
 * @property string $password [TYPE=STRING, NULLABLE=1, DEFAULT=""]
 * @property string $is_noti_email [TYPE=STRING, NULLABLE=1, DEFAULT=""]
 * @property boolean $check_in_noti [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property boolean $check_out_noti [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property boolean $perm_is_login_to_timestamp_app [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property boolean $perm_is_allow_other_employees [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property boolean $perm_is_login_to_timestation_site [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property boolean $perm_is_create_time_entries [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property boolean $perm_is_edit_time_entries [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property boolean $perm_is_punch_in_out [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property boolean $perm_is_run_reports [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property boolean $perm_is_view_gps_location_information [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property boolean $perm_is_view_pay_information [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property int $four_digit_pin [TYPE=SMALLINT, NULLABLE=1, DEFAULT=""]
 * @property boolean $is_deleted [TYPE=BOOLEAN, NULLABLE=1, DEFAULT="0"]
 * @property integer $created_by [TYPE=INTEGER, NULLABLE=1, DEFAULT=""]
 * @property string $created_at [TYPE=DATETIME, NULLABLE=0, DEFAULT="CURRENT_TIMESTAMP"]
 */
class Employee extends Model
{
	// Attributes.
	public $timestamps = false;
	protected $connection = 'mysql';
	protected $table = 'employee';
	protected $fillable = [
		'id', 'name', 'dept_id', 'is_primary', 'emp_id', 'title', 'status', 'last_activity', 'hourly_rate',
		'is_notifications', 'email', 'password', 'is_noti_email', 'check_in_noti', 'check_out_noti',
		'perm_is_login_to_timestamp_app', 'perm_is_allow_other_employees', 'perm_is_login_to_timestation_site',
		'perm_is_create_time_entries', 'perm_is_edit_time_entries', 'perm_is_punch_in_out', 'perm_is_run_reports',
		'perm_is_view_gps_location_information', 'perm_is_view_pay_information', 'four_digit_pin', 'is_deleted',
		'created_by', 'created_at'
	];
	protected $guarded = [];
	
	/* ---- Everything after this line will be preserved. ---- */
}
