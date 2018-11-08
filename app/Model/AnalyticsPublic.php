<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AnalyticsPublic extends Model
{
	protected $table      = "analytics_public";
	protected $primaryKey = 'analytics_public_id';
	protected $fillable   = ['date','ip'];
	public $timestamps = false;

}
