<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    public function campaigns(){
        return $this->hasMany(Campaign::class);
    }
}
