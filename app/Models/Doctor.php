<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
   
    protected $fillable = ['name','title','hospital_id','medical_id', 'created_at', 'updated_at'];
    public $timestamps = true;

    protected $hidden = ['created_at', 'updated_at','pivot'];

    public function hospital(){
        return $this->belongsTo('App\Models\Hospital', 'hospital_id','id');
    }

    public function services(){
        return $this->belongsToMany('App\Models\Service','doctor_service');
    }
    //accessors
    public function getGenderAttribute($val){
        return $val ==1 ? 'male':'female';
    }

    //mutators
    
}
