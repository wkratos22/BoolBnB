<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    protected $fillable = [
        'duration', 'price'

    ];

    public function habitations() {
        return $this->belongsToMany('App\Models\Habitation');
    }
}
