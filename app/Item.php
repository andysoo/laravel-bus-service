<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'bus_id', 'body', 'data-price', 'time-price', 'mend_at',
    ];

    public function bus()
    {
        return $this->belongsTo('App\Bus');
    }

    // public function setMendAtAttribute($date)
    // {
    //     $this->attributes['mend_at'] = Carbon::createFromFormat('Y-m-d', $date);
    // }
}
