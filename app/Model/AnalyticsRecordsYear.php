<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AnalyticsRecordsYear extends Model
{
	protected $table      = "analytics_records_year";
	protected $primaryKey = 'analytics_records_year_id';
	protected $fillable   = ['reference', 'total'];
	public $timestamps = false;
}