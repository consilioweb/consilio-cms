<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Newsletters extends Model
{
    protected $table      = "newsletters";
	protected $primaryKey = 'newsletters_id';
	protected $fillable   = ['name','last_name','email', 'status', 'created_at', 'updated_at'];

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

}
