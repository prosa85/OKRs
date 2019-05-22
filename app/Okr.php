<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Okr extends Model
{   
    protected $fillable = [
        "OKRs_title",
        "description",
        "created_by",
        "status",
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function krs(){
        return $this->hasMany('App\Kr','OKR_id');
    }

    public function tasks()
    {
        return $this->hasManyThrough('App\Task', 'App\Kr');
    }

    public function user(){
        return $this->hasOne("App\User", "id", "created_by");
    }
}
