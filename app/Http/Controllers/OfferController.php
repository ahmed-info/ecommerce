<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use LaravelLocalization;
use App\Http\Controllers\Lang;
use App\Http\Requests\offerRequest as RequestsOfferRequest;

class OfferController extends Controller
{
    use OfferTrait;
    public  function create()
    {
        // view form to add this offer
        return view('ajaxoffers.create');
    }

    public  function store(OfferRequest $request)
    {
        // save offer into DB using Ajax
        $file_name = $this-> saveImages($request->photo, 'images/offers'); //this method in trait    
        //insert table offers in DB
        $offer = Offer::create([
            'photo'=> $file_name,
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'price'=> $request->price,
            'details_ar'=> $request->details_ar,
            'details_en'=> $request->details_en
        ]);
        if ($offer)
        return response()->json([
            'status' => true,
            'msg' => 'تم الحفظ بنجاح',
        ]);

    else
        return response()->json([
            'status' => false,
            'msg' => 'فشل الحفظ برجاء المحاوله مجددا',
        ]);

        /*
        $msg = $var = Lang::get('messages.success add');
        return redirect()->back()->with(['success add'=> $msg]); //session
        */
    }
}
