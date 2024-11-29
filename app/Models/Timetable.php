<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    use HasFactory;

    public $table = 'timetables';

    protected $fillable = [
       'subject_id',
       'day_id',
       'hall_id',
       'user_id',
       'group_id',
    ];
}
