<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Course extends Model
{

	protected $fillable = ['teacher_id', 'access_token', 'title', 'group', 'school', 'place'];

	public function users()
	{
	    return $this->belongsToMany('App\User');
	}
}
