<?php


namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Reviewer extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
//    protected $fillable = [
//        'name', 'email', 'password',
//    ];
protected $guarded = ['id','last_login'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'certification_key'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
//    protected $casts = [
//        'email_verified_at' => 'datetime',
//    ];
    protected $dates = ['last_login'];
    
    public function communities(){
        return $this->hasMany(Community::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function onetoones(){
        return $this->hasMany(Onetoone::class);
    }
    public function plan(){
        return $this->hasOne(Plan::class);
    }
    public function channelreviewers(){
        return $this->hasMany(ChannelReviewer::class);
    }
    public function reviews(){
        return $this->hasMany(Review::class);
    }
}