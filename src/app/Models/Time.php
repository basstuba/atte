<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    use HasFactory;

    protected $guarded=['id'];
    protected $fillable=[
        'user_id',
        'date',
        'work_start',
        'work_end',
        'break_start',
        'break_end',
        'break_time',
    ];

    public function user() {
        return $this->belongsTo('App\models\User');
    }
}
