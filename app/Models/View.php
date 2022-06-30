<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    protected $fillable = [
        'ip_address',

    ];

    public function habitation() {
        return $this->belongsTo('App\Models\Habitation');
    }
}
