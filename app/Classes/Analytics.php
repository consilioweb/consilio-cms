<?php


namespace App\Classes;

use App\Model\AnalyticsPublic;
use App\Model\AnalyticsRecordsDay;
use App\Model\AnalyticsRecordsWeek;
use App\Model\AnalyticsRecordsMonth;
use App\Model\AnalyticsRecordsYear;

use Carbon\Carbon;

class Analytics {

	static $ip;
	static $date;

	static $week_last;
	static $week;

	static $month;
	static $month_last;


	public function __construct($ip) {
		self::$ip = $ip;
		self::$date = date("Y-m-d");

		self::$week = Carbon::now()->startOfWeek()->format('Y-m-d');
		self::$week_last = Carbon::parse('last week')->format('Y-m-d');

		self::$month = Carbon::now()->startOfMonth()->format('Y-m-d');
		self::$month_last = Carbon::parse('first day of last month')->format('Y-m-d');

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

			$hoje = AnalyticsRecordsDay::where('reference', self::$date)->first();
			$ontem = date("Y-m-d", mktime(0,0,0, date("m"), date("d")-1, date("y")));
			$ontem = AnalyticsRecordsDay::where('reference', $ontem)->first();

			if(!is_null($ontem)){	

				$a = ( $hoje->total - $ontem->total );

				$b = ( $a / $ontem->total );

				$c = ( $b * 100);

				if($a < 0){
					$rel = "ti-angle-down";
					$target = "danger";
					$text = $c."% de queda em Relação a ontem";
				}else{
					$rel = "ti-angle-up";
					$target = "success";
					$text = $c."% de aumento em Relação a ontem";
				}
			}else{				
				$rel = "ti-minus";
				$target = "dark";
				$text = "*Dados não calculado ainda";
				$c = "";
			}

			$return = array(
				"count" => $hoje->total, 
				"rel" => $rel, 
				"target" => $target, 
				"text" => $text, 
				"qnt" => $c,
			);

			return $return;
		}

		if($type == 2){

			$week = AnalyticsRecordsWeek::where('reference', self::$week)->first();
			$week_last = AnalyticsRecordsWeek::where('reference', self::$week_last)->first();

			if(!is_null($week_last)){	

				$a = ( $week->total - $week_last->total );

				$b = ( $a / $week_last->total );

				$c = ( $b * 100);

				if($a < 0){
					$rel = "ti-angle-down";
					$target = "danger";
					$text = $c."% de queda em Relação a semana passada";
				}else{
					$rel = "ti-angle-up";
					$target = "success";
					$text = $c."% de aumento em Relação a semana passada";
				}
			}else{				
				$rel = "ti-minus";
				$target = "dark";
				$text = "*Dados não calculado ainda";
				$c = "";
			}

			$return = array(
				"count" => $week->total, 
				"rel" => $rel, 
				"target" => $target, 
				"text" => $text, 
				"qnt" => $c,
			);

			return $return;
		}

		if($type == 3){

			$month = AnalyticsRecordsMonth::where('reference', self::$month)->first();
			$month_last = AnalyticsRecordsMonth::where('reference', self::$month_last)->first();

			if(!is_null($month_last)){				

				$a = ( $month->total - $month_last->total );

				$b = ( $a / $month_last->total );

				$c = ( $b * 100);

				if($a < 0){
					$rel = "ti-angle-down";
					$target = "danger";
					$text = $c."% de queda em Relação a semana passada";
				}else{
					$rel = "ti-angle-up";
					$target = "success";
					$text = $c."% de aumento em Relação a semana passada";
				}

			}else{				
				$rel = "ti-minus";
				$target = "dark";
				$text = "*Dados não calculado ainda";
				$c = "";
			}
			$return = array(
				"count" => $month->total, 
				"rel" => $rel, 
				"target" => $target, 
				"text" => $text, 
				"qnt" => $c,
			);

			return $return;

		}

		if($type == 4){
			$date = date('01/01/Y');
			$year = AnalyticsRecordsYear::where('reference', date('Y-01-01'))->first();
			$return = array("count" => $year->total, "date" => $date);
			return $return;
		}

	}

}