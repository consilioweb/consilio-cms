<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AdBanners extends Model
{
    protected $table      = "ad_banners";
	protected $primaryKey = 'ad_banners_id';
	protected $fillable   = ['ad_clients_id','ad_locations_id','type', 'title', 'price', 'start_date', 'end_date','code','file','url', 'view', 'click', 'status', 'states_id','created_at', 'updated_at'];

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

	public function advertiser()
    {
        return $this->hasOne('App\Model\AdClients', 'ad_clients_id', 'ad_clients_id');
    }

	public function location()
    {
        return $this->hasOne('App\Model\AdLocations', 'ad_locations', 'ad_locations');
    }


}
