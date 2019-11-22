<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $guarded = ['id'];
    public function areas(){
        return $this->hasMany(Area::class);
    }
}
