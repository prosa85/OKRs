<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kr extends Model
{

    protected $fillable =[
        "title",
        "description",
        "OKR_id",
        "status",
    ];

    public function okr()
    {
        return $this->belongsTo('App\Okr','OKR_id', 'id');
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
