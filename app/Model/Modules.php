<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Modules extends Model
{
    protected $table      = "modules";
	protected $primaryKey = 'modules_id';
	protected $fillable   = 
	['module','type_module', 'title', 'subtitle',  'featured', 'category', 'featured_image', 'summary', 'content', 'credit_author', 'tags', 'initial_date', 'end_date' ,'starting_time', 'end_time',
	'publication_date', 'amount_1', 'amount_2', 'amount_3', 'check_1', 'check_2', 'check_3', 'external_link', 'optimization_seo', 'image_gallery', 'video_gallery', 'file_gallery',
	'notifications', 'insert_users_id', 'update_users_id','status', 'created_at', 'updated_at'];

	public function status() {
		
		switch ($this->status) {
			case '1':
				return '<i class="fa fa-check"></i>';
			break;
			case '2':
				return '<i  class="fa fa-times"></i>';
			break;
		}
	}
    public function type_module() {
        
        switch ($this->type_module) {
            case '1':
                return 'Página Única';
            break;
            case '2':
                return 'Listagem de Registros';
            break;
        }
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
        return $this->hasMany('App\Model\Contents', 'modules_id', 'modules_id');
    }

    public function categories()
    {
        return $this->hasMany('App\Model\Categories', 'modules_id', 'modules_id');
    }

    public function gallery()
    {
        return $this->hasMany('App\Model\Gallery', 'modules_id', 'modules_id');
    }

}
