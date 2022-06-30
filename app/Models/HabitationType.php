<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HabitationType extends Model
{
    protected $fillable = [
        'label', 'icon'

    ];

    public function habitations() {
        return $this->hasMany('App\Models\Habitation');
    }
}
