<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Habitation extends Model
{
    protected $fillable = [
        'title',
        'description',
        'price',
        'address',
        'latitude',
        'longitude',
        'guests_number',
        'rooms_number',
        'beds_number',
        'bathrooms_number',
        'square_meters',
        'image',
        'visible'
    ];

    public function user() {
        return $this->belogsTo('App\User');
    }

    public function habitationtype() {
        return $this->belongsTo('App\Models\HabitationType');
    }

    public function messages() {
        return $this->hasMany('App\Models\Message');
    }

    public function views() {
        return $this->hasMany('App\Models\View');
    }

    public function sponsorships() {
        return $this->belongsToMany('App\Models\Sponsorship');
    }

    public function services() {
        return $this->belongsToMany('App\Models\Service');
    }

    public function tags() {
        return $this->belongsToMany('App\Models\Tag');
    }
}