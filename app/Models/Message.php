<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'name', 'email_sender','text_message'

    ];

    public function habitation() {
        return $this->belongsTo('App\Models\Habitation');
    }
}
