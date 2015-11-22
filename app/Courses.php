<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Courses extends Model
{

	protected $fillable = ['teacher_id', 'title', 'group', 'school', 'place'];
}
