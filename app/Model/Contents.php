<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class Contents extends Model
{
	protected $table      = "contents";
	protected $primaryKey = 'contents_id';
	protected $fillable   = 
	['modules_id','categories_id',	 'title', 'subtitle',  'featured', 'category', 'featured_image', 'summary', 'content', 'credit_author', 'tags', 'initial_date', 'end_date' ,'starting_time', 'end_time',
	'publication_date', 'amount_1', 'amount_2', 'amount_3', 'check_1', 'check_2', 'check_3', 'external_link', 'optimization_seo', 'image_gallery', 'video_gallery', 'file_gallery',
	'notifications', 'insert_users_id', 'update_users_id','status', 'created_at', 'updated_at'];

	public function status() {
		
		switch ($this->status) {
			case '1':
			return 'Ativo';
			break;
			case '2':
			return 'Inativo';
			break;
		}
	}

	public function getInitialDateAttribute($initial_date)
	{
		return Carbon::createFromFormat('Y-m-d', $initial_date)->format('d/m/Y');
	}

	public function setInitialDateAttribute($initial_date)
	{
		$this->attributes['initial_date'] = Carbon::createFromFormat('d/m/Y', $initial_date)->format('Y-m-d');
	}

	public function getEndDateAttribute($end_date)
	{
		return Carbon::createFromFormat('Y-m-d', $end_date)->format('d/m/Y');
	}

	public function setEndDateAttribute($end_date)
	{
		$this->attributes['end_date'] = Carbon::createFromFormat('d/m/Y', $end_date)->format('Y-m-d');
	}

	public function getPublicationDateAttribute($publication_date)
	{
		return Carbon::createFromFormat('Y-m-d', $publication_date)->format('d/m/Y');
	}

	public function setPublicationDateAttribute($publication_date)
	{
		$this->attributes['publication_date'] = Carbon::createFromFormat('d/m/Y', $publication_date)->format('Y-m-d');
	}


	public function modules()
	{
		return $this->hasOne('App\Model\Users', 'modules_id', 'modules_id');
	}


	public function categorie()
	{
		return $this->hasOne('App\Model\Categories', 'categories_id', 'categories_id');
	}

	public function user_insert()
	{
		return $this->hasOne('App\Model\Users', 'insert_users_id', 'users_id');
	}

	public function user_update()
	{
		return $this->hasOne('App\Model\Users', 'update_users_id', 'users_id');
	}


	public function gallery()
	{
		return $this->hasMany('App\Model\Gallery', 'contents_id', 'contents_id');
	}

	public function featured() {
		
		switch ($this->featured) {
			case '1':
			return 'Ativo';
			break;
			case '2':
			return 'Inativo';
			break;
		}
	}
	public function check_1() {
		
		switch ($this->check_1) {
			case '1':
			return 'Ativo';
			break;
			case '2':
			return 'Inativo';
			break;
		}
	}
	public function check_2() {
		
		switch ($this->check_2) {
			case '1':
			return 'Ativo';
			break;
			case '2':
			return 'Inativo';
			break;
		}
	}
	public function check_3() {
		
		switch ($this->check_3) {
			case '1':
			return 'Ativo';
			break;
			case '2':
			return 'Inativo';
			break;
		}
	}

}
