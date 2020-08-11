<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
         //  اذا مانريد ندخل الكريتد ات والابديتد ات الى قاعد البيانات
        public $timestamps = false;
        protected $fillable = ['name','viewer'];
        //protected $hidden = ['created_at','updated_at']; //hidden all project
}
