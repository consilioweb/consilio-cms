<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table      = "gallery";
	protected $primaryKey = 'gallery_id';
	protected $fillable   = ['modules_id','contents_id', 'title', 'legend','file', 'type', 'extension', 'insert_users_id', 'update_users_id',  'status', 'created_at', 'updated_at'];

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
		
		switch ($this->type) {
			case '1':
				return "Imagens";
			break;
			case '2':
				return "Arquivos";
			break;
		}
	}


	public function module()
    {
        return $this->hasOne('App\Model\Modules', 'modules_id', 'modules_id');
    }

    
	public function user_insert()
    {
        return $this->hasOne('App\Model\Users', 'insert_users_id', 'users_id');
    }

	public function user_update()
    {
        return $this->hasOne('App\Model\Users', 'update_users_id', 'users_id');
    }

    public function content()
    {
        return $this->hasOne('App\Model\Contents', 'contents_id', 'contents_id');
    }


}
