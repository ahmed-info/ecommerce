<?php

namespace App\Models;

use App\Scopes\OfferScope;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
   // protected $table = 'myoffer'; //بحالة نريد تغير اسم الجدول الافترضي 
    // public $timestamps = false; //  اذا مانريد ندخل الكريتد ات والابديتد ات الى قاعد البيانات
    protected $fillable = ['photo','name_ar','name_en','price','details_ar','details_en','status','created_at','updated_at'];
    protected $hidden = ['created_at','updated_at']; //hidden all project

    ############ Begin local scopes ################
    public function scopeInActive($query)
    {
        return $query->where('status',0);
    }

    public function scopeInvalid($query)
    {
        return $query->where('status',0)->whereNull('details_ar');
    }
    ############ End scopes local ################

    //Make register global scope
    /*
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new OfferScope);
    }
    */
    //mutators

    /*
    public function setNameEnAttribute($value){
        $this-> attributes['name_en'] = strtoupper($value);
    }
    */
}
