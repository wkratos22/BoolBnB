<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'label', 'icon'

    ];

    public function habitations() {
        return $this->belongsToMany('App\Models\Habitation');
    }
}
