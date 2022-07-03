<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'image_url', 'habitation_id'

    ];

    public function habitation() {
        return $this->belongsTo('App\Models\Habitation');
    }
}
