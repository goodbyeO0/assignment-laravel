<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subject;
use App\Models\Day;
use App\Models\Hall;

class Timetable extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_id',
        'group_id',
        'hall_id',
        'day',
        'start_time',
        'end_time'
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function hall()
    {
        return $this->belongsTo('App\Models\Hall', 'hall_id');
    }

    public function day(){
        return $this->belongsTo(Day::class);
    }

}
