<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    protected $primaryKey = 'rank_id';
    public $incrementing = false;

    public function records()
    {
        return $this->hasMany(Record::class, 'record_id');
    }
}
