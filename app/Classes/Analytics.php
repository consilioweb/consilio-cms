<?php


namespace App\Classes;

use App\Model\AnalyticsPublic;
use App\Model\AnalyticsRecordsDay;
use App\Model\AnalyticsRecordsWeek;
use App\Model\AnalyticsRecordsMonth;
use App\Model\AnalyticsRecordsYear;


class Analytics {

	static $ip;
	static $date;

	public function __construct($ip) {
		self::$ip = $ip;
		self::$date = date("Y-m-d");

		$this->CheckVisitors();
	}

	protected function CheckVisitors()
	{
		$analytics = AnalyticsPublic::where('ip', self::$ip)->where('date', self::$date)->count();

		if($analytics == 0){
			AnalyticsPublic::create([
				"ip" => self::$ip,
				"date" => self::$date,
			]);
		}
	}

	public static function countVisitors($type)
	{

		if($type == 1){
			$days = AnalyticsRecordsDay::where('reference', self::$date)->first();
			return $days->total;
		}

		if($type == 2){
			$Week = date('w');
			$reference_week =   date('Y-m-d', strtotime('-'.$Week.' days'));
			$week = AnalyticsRecordsWeek::where('reference', $reference_week)->first();
			return $week->total;
		}

		if($type == 3){
			$month = AnalyticsRecordsMonth::where('reference', date('Y-m-01'))->first();
			return $month->total;
		}

		if($type == 4){
			$year = AnalyticsRecordsYear::where('reference', date('Y-01-01'))->first();
			return $year->total;
		}
	}

}