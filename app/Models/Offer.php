<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
   // protected $table = 'myoffer'; //بحالة نريد تغير اسم الجدول الافترضي 
    // public $timestamps = false; //  اذا مانريد ندخل الكريتد ات والابديتد ات الى قاعد البيانات
    protected $fillable = ['name','price','details','created_at','updated_at'];
    protected $hidden = ['created_at','updated_at']; //hidden all project

}
