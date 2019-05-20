<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Okr extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function krs(){
        return $this->hasMany('App\Kr');
    }

    public function tasks()
    {
        return $this->hasManyThrough('App\Task', 'App\Kr');
    }
}
