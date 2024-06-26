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
        'total_break',
        'work_time',
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function closeds() {
        return $this->hasMany('App\Models\Closed');
    }
}
