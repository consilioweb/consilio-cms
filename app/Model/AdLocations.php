<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AdLocations extends Model
{
    protected $table      = "ad_locations";
	protected $primaryKey = 'ad_locations_id';
	protected $fillable   = ['title','size', 'status', 'created_at', 'updated_at'];

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

	public function adverts()
    {
        return $this->hasMany('App\Model\AdBanners', 'ad_locations', 'ad_locations');
    }


}
