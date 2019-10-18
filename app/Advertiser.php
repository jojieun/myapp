<?php

namespace App;

 

use Illuminate\Notifications\Notifiable;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
 

class Advertiser extends Authenticatable

{

    use Notifiable;
    protected $guard = 'advertiser';
    /**

     * The attributes that are mass assignable.

     *

     * @var array

     */

    protected $fillable = [

        'name', 'email', 'password', 'mobile_num', 'receive_agreement'

    ];

    /**

     * The attributes that should be hidden for arrays.

     *

     * @var array

     */

    protected $hidden = [

        'password', 'remember_token',

    ];
    public function brands(){
        return $this->hasMany(brand::class);
    }
    public function communities(){
        return $this->hasMany(Community::class);
    }
    public function campaigns(){
        return $this->hasMany(Campaign::class);
    }

}
