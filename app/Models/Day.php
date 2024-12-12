<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;

    public $table = 'days';
    
    // Disable timestamps
    public $timestamps = false;
    
    protected $fillable = [
        'day_name',
    ];
}
