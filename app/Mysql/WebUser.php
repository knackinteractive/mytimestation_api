<?php

namespace App\Mysql;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id [TYPE=INTEGER, NULLABLE=0, DEFAULT=""]
 * @property string $company_name [TYPE=STRING, NULLABLE=0, DEFAULT=""]
 * @property string $email [TYPE=STRING, NULLABLE=0, DEFAULT=""]
 * @property string $password [TYPE=STRING, NULLABLE=0, DEFAULT=""]
 * @property integer $attendance_mode [TYPE=INTEGER, NULLABLE=1, DEFAULT=""]
 * @property boolean $is_enable_location_tagging [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property boolean $is_require_location [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property boolean $time_rounding [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property boolean $is_display_time_round [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property boolean $date_format [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property boolean $time_format [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property boolean $hours_format [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property boolean $auto_time_deduct [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property boolean $attndnce_every_hours [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property boolean $default_report_date_range [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property boolean $is_include_today [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property boolean $card_info_1 [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property boolean $card_info_2 [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property boolean $card_info_3 [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property boolean $card_info_4 [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property boolean $card_font_size [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property boolean $perm_type [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property boolean $is_authorize_ts_devices [TYPE=BOOLEAN, NULLABLE=1, DEFAULT="0"]
 * @property boolean $is_create_edit_admin [TYPE=BOOLEAN, NULLABLE=1, DEFAULT="0"]
 * @property boolean $is_create_edit_dept [TYPE=BOOLEAN, NULLABLE=1, DEFAULT="0"]
 * @property boolean $is_create_edit_emp [TYPE=BOOLEAN, NULLABLE=1, DEFAULT="0"]
 * @property boolean $is_create_time_entries [TYPE=BOOLEAN, NULLABLE=1, DEFAULT="0"]
 * @property boolean $is_edit_company_settings [TYPE=BOOLEAN, NULLABLE=1, DEFAULT="0"]
 * @property boolean $is_edit_time_entries [TYPE=BOOLEAN, NULLABLE=1, DEFAULT="0"]
 * @property boolean $is_manage_billing_plan [TYPE=BOOLEAN, NULLABLE=1, DEFAULT="0"]
 * @property boolean $is_print_employee_cards [TYPE=BOOLEAN, NULLABLE=1, DEFAULT="0"]
 * @property boolean $is_run_reports [TYPE=BOOLEAN, NULLABLE=1, DEFAULT="0"]
 * @property boolean $is_view_gps_location [TYPE=BOOLEAN, NULLABLE=1, DEFAULT="0"]
 * @property boolean $is_view_pay_info [TYPE=BOOLEAN, NULLABLE=1, DEFAULT="0"]
 * @property boolean $is_admin [TYPE=BOOLEAN, NULLABLE=1, DEFAULT="0"]
 * @property integer $created_by [TYPE=INTEGER, NULLABLE=1, DEFAULT=""]
 * @property string $created_at [TYPE=DATETIME, NULLABLE=0, DEFAULT="CURRENT_TIMESTAMP"]
 */
class WebUser extends Model
{
	// Attributes.
	public $timestamps = false;
	protected $connection = 'mysql';
	protected $table = 'web_user';
	protected $fillable = [
		'id', 'company_name', 'email', 'password', 'attendance_mode', 'is_enable_location_tagging',
		'is_require_location', 'time_rounding', 'is_display_time_round', 'date_format', 'time_format',
		'hours_format', 'auto_time_deduct', 'attndnce_every_hours', 'default_report_date_range', 'is_include_today',
		'card_info_1', 'card_info_2', 'card_info_3', 'card_info_4', 'card_font_size', 'perm_type',
		'is_authorize_ts_devices', 'is_create_edit_admin', 'is_create_edit_dept', 'is_create_edit_emp',
		'is_create_time_entries', 'is_edit_company_settings', 'is_edit_time_entries', 'is_manage_billing_plan',
		'is_print_employee_cards', 'is_run_reports', 'is_view_gps_location', 'is_view_pay_info', 'is_admin',
		'created_by', 'created_at'
	];
	protected $guarded = [];
	
	/* ---- Everything after this line will be preserved. ---- */
}
