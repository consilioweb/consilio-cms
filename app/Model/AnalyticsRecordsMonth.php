<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AnalyticsRecordsMonth extends Model
{
	protected $table      = "analytics_records_month";
	protected $primaryKey = 'analytics_records_month_id';
	protected $fillable   = ['reference', 'total'];
	public $timestamps = false;
}