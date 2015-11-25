<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Seance extends Model
{
    protected $fillable = ['course_id', 'classroom_id', 'start_hours', 'end_hours'];
    protected $dates = ['published_at','created_at','start_hours','end_hours'];
}
