<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Polls extends Model
{
	protected $table      = "polls";
	protected $primaryKey = 'polls_id';
	protected $fillable   = ['question','start_date', 'end_date','view','show','status', 'created_at', 'updated_at'];

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
	public function show() {
		
		switch ($this->show) {
			case '1':
			return "Mostrar";
			break;
			case '2':
			return "Esconder";
			break;
		}
	}



	public function questions()
	{
		return $this->hasMany('App\Model\PollsQuestions', 'polls_id', 'polls_id');
	}

	public function sumVotes()
	{
		$sum = 0;
		foreach ($this->questions() as $value){
			$sum =+ $value->votes;
		}
		return $sum;

	}

	public function getStartDateAttribute($start_date)
	{
		if(strlen($start_date)){
			return Carbon::createFromFormat('Y-m-d', $start_date)->format('d/m/Y');
		}else{
			return null;
		}	
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
		if(strlen($end_date)){
			return Carbon::createFromFormat('Y-m-d', $end_date)->format('d/m/Y');
		}else{
			return null;
		}	
	}

	public function setEndDateAttribute($end_date)
	{
		if(strlen($end_date)){
			$this->attributes['end_date'] = Carbon::createFromFormat('d/m/Y', $end_date)->format('Y-m-d');
		}else{
			$this->end_date = null;
		}
	}

	public function setView()
	{
		$this->view =$this->view + 1;
		$this->save();
		return $this;
	}


}
