<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Record extends Model
{
    protected $primaryKey = 'record_id';
    public $incrementing = false;
    //public $timestamps = false;

    public function getTimeStampAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }

    //protected $with = ['skills', 'badges'];

    public function rank()
    {
        return $this->belongsTo(Rank::class, 'rank_id');
    }

    public function trainee()
    {
        return $this->belongsTo(Trainee::class, 'trainee_id');
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'skills_records', 'skill_id', 'record_id');
    }

    public function badges()
    {
        return $this->belongsToMany(Badge::class, 'badges_records', 'badge_id', 'record_id');
    }
}
