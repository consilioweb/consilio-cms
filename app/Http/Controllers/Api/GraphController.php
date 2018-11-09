<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


use App\Model\AnalyticsRecordsMonth;

class GraphController extends Controller
{

	public function visitors(Request $request)
	{

		$dateStart = date('Y-01-01');
		$dateEnd = date('Y-m-01');

		$month = AnalyticsRecordsMonth::whereBetween('reference', [$dateStart, $dateEnd])->get();


		$meses = array();
		$count = array();


		foreach ($month as $value) {

			$mes = explode("-", $value->reference);
			$meses[] = getMonth($mes[1]);
			$count[] = $value->total;

		}



		$retorno = array("meses" => $meses, "total" => $count);


		return response()->json($retorno);
	}
}
