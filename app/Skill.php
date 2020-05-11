<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $primaryKey = 'skill_id';
    public $incrementing = false;

    public function records()
    {
        return $this->belongsToMany(Record::class, 'records_skills_id');
    }
}
