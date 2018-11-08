<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AnalyticsRecordsWeek extends Model
{
	protected $table      = "analytics_records_week";
	protected $primaryKey = 'analytics_records_week_id';
	protected $fillable   = ['reference', 'total'];
	public $timestamps = false;
}