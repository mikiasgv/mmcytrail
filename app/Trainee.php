<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trainee extends Model
{
    protected $primaryKey = 'trainee_id';
    public $incrementing = false;

    //protected $with = ['records'];

    public function records()
    {
        return $this->hasMany(Record::class, 'trainee_id');
    }
}
