<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AdBanners extends Model
{
	protected $table      = "ad_banners";
	protected $primaryKey = 'ad_banners_id';
	protected $fillable   = ['ad_clients_id','ad_locations_id','type', 'title', 'price', 'start_date', 'end_date','code','code_google', 'file','url', 'view', 'click', 'status', 'states_id','created_at', 'updated_at'];

	public function status() {
		
		switch ($this->status) {
			case '1':
			return "Ativo";
			break;
			case '2':
			return "Inativo";
			break;
		}
	}
	public function type() {
		
		switch ($this->status) {
			case '1':
			return "Arquivo";
			break;
			case '2':
			return "Google";
			break;
			case '3':
			return "Código/HTML5";
			break;
		}
	}


	public function getStartDateAttribute($start_date)
	{
		return Carbon::createFromFormat('Y-m-d', $start_date)->format('d/m/Y');
	}

	public function setStartDateAttribute($start_date)
	{
		if(strlen($start_date)){
			$this->attributes['start_date'] = Carbon::createFromFormat('d/m/Y', $start_date)->format('Y-m-d');
		}else{
			$this->start_date = null;
		}
	}


	public function getEndDateAttribute($end_date)
	{
		return Carbon::createFromFormat('Y-m-d', $end_date)->format('d/m/Y');
	}

	public function setEndDateAttribute($end_date)
	{
		if(strlen($end_date)){
			$this->attributes['end_date'] = Carbon::createFromFormat('d/m/Y', $end_date)->format('Y-m-d');
		}else{
			$this->end_date = null;
		}
	}


	public function advertiser()
	{
		return $this->hasOne('App\Model\AdClients', 'ad_clients_id', 'ad_clients_id');
	}

	public function location()
	{
		return $this->hasOne('App\Model\AdLocations', 'ad_locations_id', 'ad_locations_id');
	}


}
