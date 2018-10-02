<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id [TYPE=INTEGER, NULLABLE=0, DEFAULT=""]
 * @property int $no_of_emp [TYPE=SMALLINT, NULLABLE=0, DEFAULT=""]
 * @property int $no_of_admin [TYPE=SMALLINT, NULLABLE=0, DEFAULT=""]
 * @property decimal $price [TYPE=DECIMAL, NULLABLE=0, DEFAULT=""]
 * @property boolean $additional_no_of_admin [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 * @property boolean $is_pay_yearly [TYPE=BOOLEAN, NULLABLE=1, DEFAULT=""]
 */
class Plan extends Model
{
	// Attributes.
	public $timestamps = false;
	protected $connection = 'mysql';
	protected $table = 'plan';
	protected $fillable = ['id', 'no_of_emp', 'no_of_admin', 'price', 'additional_no_of_admin', 'is_pay_yearly'];
	protected $guarded = [];
	
	/* ---- Everything after this line will be preserved. ---- */
}
