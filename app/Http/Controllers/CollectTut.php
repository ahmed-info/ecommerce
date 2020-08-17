<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;

class CollectTut extends Controller
{
    public function index(){
        /*
        $numbers = [1,2,3,4];
        $col = collect($numbers);
        $collAvg = $col->avg();
        return $collAvg;
        */

        /*
        $names = collect(['name','age']);
        return $names->combine(['ahmed','27']); */

        /*
        $ages = collect([24,2,55,65,18]);
        return $ages->count();
        */

        /*
        $ages = collect([7,24,24,2,55,65,18]);
        return $ages->countBy(); */

        $ages = collect([7,24,24,2,55,65,18]);
        return $ages->duplicates();

        //each
        //fillter
        //search
        //transform
    }

    //execute on column
    public function complex()
    {
        $mainoffers = Offer::get();

        //remove & add
        /*
        $mainoffers->each(function($offer){
            unset($offer->details_ar,$offer->details_en); //remove
            $offer->name = 'Ali'; //add
            return $offer;
        });
        return $mainoffers;
        */
        //or
/*
        foreach($mainoffers as $offer){
            unset($offer->details_ar, $offer->details_en);
            $offer->name = 'Ali';
        }
        return $mainoffers;
        */
    }

    //result on all table
    public function complexFilter(){
        $mainoffers = Offer::get();
        $offersArr = collect($mainoffers);
        $resultOfFilter = $offersArr->filter(function($key, $value){
            return $key['id'] >= 42;
        });
        return array_values($resultOfFilter->all());  //get only values of array
    }
    public function complexTransform(){
        $mainoffers = Offer::get();
        $offersArr = collect($mainoffers);
        $resultOfFilter = $offersArr->transform(function($key, $value){
            return $key['name_ar'].' '.'اسم:';
        });
        return $resultOfFilter; 
    }
}
