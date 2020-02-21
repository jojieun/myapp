<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    use Searchable;
    protected $guarded = ['id'];
}
