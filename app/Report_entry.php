<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report_entry extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     * Report associated to this entry
     */
    public function report(){
        return $this->belongsTo(App\Report::class, 'id', 'report_id');
    }
}
