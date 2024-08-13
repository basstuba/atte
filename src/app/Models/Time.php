<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    public function formatTime($timeInSeconds) {
        $hours = floor($timeInSeconds / 3600);
        $minutes = floor(($timeInSeconds % 3600) / 60);
        $seconds = $timeInSeconds % 60;

        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }

    public function getPreviousDate($baseDate) {
        $subBase = new Carbon($baseDate);

        return $subBase->subDay()->format('Y-m-d');
    }

    public function getNextDate($baseDate) {
        $addBase = new Carbon($baseDate);

        return $addBase->addDay()->format('Y-m-d');
    }

    public function getPreviousMonth($baseMonth) {
        $subBaseMonth = new Carbon($baseMonth);

        return $subBaseMonth->subMonth()->format('Y-m-d');
    }

    public function getNextMonth($baseMonth) {
        $addBaseMonth = new Carbon($baseMonth);

        return $addBaseMonth->addMonth()->format('Y-m-d');
    }
}
