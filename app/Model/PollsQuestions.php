<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PollsQuestions extends Model
{
	protected $table      = "polls_questions";
	protected $primaryKey = 'polls_questions_id';
	protected $fillable   = ['polls_id','question','votes', 'status', 'created_at', 'updated_at'];

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

	public function poll()
	{
		return $this->hasOne('App\Model\Polls', 'polls_id', 'polls_id');
	}
	public function setVote()
	{
		$this->votes = $this->votes + 1;
		$this->save();
		return $this;
	}

}
