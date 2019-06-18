<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Okr extends Model
{
    protected $appends = ['categoriesArray' ,'contributorsArray', 'vxImpactArray', 'impactGroupsArray'];
    protected $fillable = [
        "OKRs_title",
        "description",
        "created_by",
        "status",
        "categories",
        "contributors",
        "impact_groups",
        "target_date",
        "completion_date",
        "vx_impact",
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

    public function comments(){
        return $this->morphMany('App\Comment', 'commentable');
    }

    /**
     * Categories
     * @param $value
     * @return array
     */
    public function getCategoriesArrayAttribute($value)
    {
        return explode('; ', $this->categories);
    }

    public function setCategoriesAttribute($value)
    {
        $this->attributes['categories'] =  implode('; ', $value);
    }

    /**
     * Impact Groups
     */
    public function setImpactGroupsAttribute($value)
    {
        $this->attributes['impact_groups'] =  implode('; ', $value);
    }

    public function getImpactGroupsArrayAttribute($value)
    {
        return explode('; ', $this->impact_groups);
    }

    /**
     * Contributors
     */
    public function setContributorsAttribute($value)
    {
        $this->attributes['contributors'] =  implode('; ', $value);
    }

    public function getContributorsArrayAttribute($value)
    {
        return explode('; ', $this->contributors);
    }
    /**
     * vxImpact
     */
    /**
     * Contributors
     */
    public function setVxImpactAttribute($value)
    {
        $this->attributes['vx_impact'] =  implode('; ', $value);
    }

    public function getVxImpactArrayAttribute($value)
    {
        return explode('; ', $this->vx_impact);
    }
}
