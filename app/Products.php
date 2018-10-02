<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id [TYPE=INTEGER, NULLABLE=0, DEFAULT=""]
 * @property integer $user_id [TYPE=INTEGER, NULLABLE=0, DEFAULT=""]
 * @property string $name [TYPE=STRING, NULLABLE=0, DEFAULT=""]
 * @property integer $price [TYPE=INTEGER, NULLABLE=0, DEFAULT=""]
 * @property integer $quantity [TYPE=INTEGER, NULLABLE=0, DEFAULT=""]
 * @property string $created_at [TYPE=DATETIME, NULLABLE=1, DEFAULT=""]
 * @property string $updated_at [TYPE=DATETIME, NULLABLE=1, DEFAULT=""]
 */
class Products extends Model
{
	// Attributes.
	public $timestamps = false;
	protected $connection = 'mysql';
	protected $table = 'products';
	protected $fillable = ['id', 'user_id', 'name', 'price', 'quantity', 'created_at', 'updated_at'];
	protected $guarded = [];
	
	/* ---- Everything after this line will be preserved. ---- */
}
