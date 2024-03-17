<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Closed extends Model
{
    use HasFactory;

    protected $guarded=['id'];
    protected $fillable=[
        'time_id',
        'break_start',
        'break_end',
        'break_time',
    ];

    public function time() {
        return $this->belongsTo('App\Models\Time');
    }
}
