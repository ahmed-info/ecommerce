<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $table = "phones";
    protected $fillable = ['code','phone','user_id'];
    public $timestamps = false;

    protected $hidden = [
        'user_id'
    ];
    
    ################# Begin  Relations ########################

    public function user(){
       return $this->belongsTo('App\User');
    }

    ################# End  Relations ########################
}
