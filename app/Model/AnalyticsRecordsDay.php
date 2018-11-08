<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AnalyticsRecordsDay extends Model
{
	protected $table      = "analytics_records_day";
	protected $primaryKey = 'analytics_records_day_id';
	protected $fillable   = ['reference', 'total'];
	public $timestamps = false;
}