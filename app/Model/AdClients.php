<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AdClients extends Model
{
    protected $table      = "ad_clients";
	protected $primaryKey = 'ad_clients_id';
	protected $fillable   = ['logo','title','phone', 'email', 'cnpj', 'priority', 'status','created_at', 'updated_at'];

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
	public function priority() {
		
		switch ($this->priority) {
			case '3':
				return '<span class="label label-rounded label-success">Alta</span>';
			break;
			case '2':
				return '<span class="label label-rounded label-warning">Média</span>';
			break;
			case '1':
				return '<span class="label label-rounded label-inverse">Baixa</span>';
			break;
		}
	}

	public function adverts()
    {
        return $this->belongsToMany('App\Model\AdBenners', 'ad_clients_id', 'ad_clients_id');
    }


}
 