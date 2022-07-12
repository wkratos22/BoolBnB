<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Habitation extends Model
{
    protected $fillable = [
        'title',
        'habitation_type_id',
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
        'visible'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function habitationType() {
        return $this->belongsTo('App\Models\HabitationType');
    }

    public function messages() {
        return $this->hasMany('App\Models\Message');
    }

    public function images() {
        return $this->hasMany('App\Models\Image');
    }

    public function views() {
        return $this->hasMany('App\Models\View');
    }

    public function sponsorships() {
        return $this->belongsToMany('App\Models\Sponsorship')->withPivot('start_date', 'end_date');
    }

    public function services() {
        return $this->belongsToMany('App\Models\Service');
    }

    public function tags() {
        return $this->belongsToMany('App\Models\Tag');
    }
}