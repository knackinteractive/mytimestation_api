<?php

namespace App\Mysql;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id [TYPE=INTEGER, NULLABLE=0, DEFAULT=""]
 * @property string $migration [TYPE=STRING, NULLABLE=0, DEFAULT=""]
 * @property integer $batch [TYPE=INTEGER, NULLABLE=0, DEFAULT=""]
 */
class Migrations extends Model
{
	// Attributes.
	public $timestamps = false;
	protected $connection = 'mysql';
	protected $table = 'migrations';
	protected $fillable = ['id', 'migration', 'batch'];
	protected $guarded = [];
	
	/* ---- Everything after this line will be preserved. ---- */
}
