<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Badge extends Model
{
    protected $primaryKey = 'badge_id';
    public $incrementing = false;

    public function records()
    {
        return $this->belongsToMany(Record::class);
    }
}
