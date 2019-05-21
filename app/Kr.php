<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kr extends Model
{
    public function okr()
    {
        return $this->belongsTo('App\Okr');
    }

    /**
     * get the User relationship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tasks(){
        return $this->hasMany('App\Task');
    }
}
