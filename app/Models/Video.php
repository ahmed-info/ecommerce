<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
         public $timestamps = false; //  اذا مانريد ندخل الكريتد ات والابديتد ات الى قاعد البيانات
        protected $fillable = ['name','viewer'];
        //protected $hidden = ['created_at','updated_at']; //hidden all project
}
