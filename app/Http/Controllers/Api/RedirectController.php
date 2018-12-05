<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\ClientController;

use App\Model\AdBanners;
use Illuminate\Support\Facades\Redirect;

class RedirectController extends Controller
{

	public function ads($id)
	{
		$ad_banners = AdBanners::where('ad_banners_id', $id)->where('status', TRUE)->first()->setClick();
		return Redirect::to($ad_banners->url);
	}
}
