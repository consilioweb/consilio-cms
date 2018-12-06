<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\CmsController;

use Illuminate\Http\Request; 

use App\Http\Requests;
use DB;

class DataBaseController extends CmsController
{

	public function backup()
	{
		$tables = DB::select('SHOW TABLES');
		$db = [
			'host'     => getenv('DB_HOST'),
			'database' => getenv('DB_DATABASE'),
			'username' => getenv('DB_USERNAME'),
			'password' => getenv('DB_PASSWORD')
		];

		return view("cms/pages/database/backup", array(
			"tables" => $tables,
			"db" => $db,
		));
	}

	


}
