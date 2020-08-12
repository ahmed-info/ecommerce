<?php

namespace App\Http\Controllers;

use App\Http\Requests\offerRequest;
use App\Http\Requests\offerRequestUpdate;
use App\Models\Offer;
use App\Traits\OfferTrait;
use App\Events\VideoViewerEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Lang;
use LaravelLocalization;
use Illuminate\Support\Facades\Storage;


class CrudController extends Controller
{
    use OfferTrait;
    public function __construct()
    {
        
    }

    public function getOffers(){
        return Offer::select('id','name')->get(); //select * from--
    }

    /*
    public function store()
    {
        // insert into ----
        Offer::create([
            'name' =>'offer2',
            'price'=>'1500',
            'details'=>'offer details'
        ]);
    }
    */

    public function create()
    {
        return view('offers.create');
    }

    public function store(offerRequest $request)
    {
        //validate data before insert database
        /*
        $rules = $request->rules();
        $messages = $request->messages();
        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()){
            //return $validator->errors()->first();
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        */
        //save photo in folder
        $file_name = $this-> saveImages($request->photo, 'images/offers'); //this method in trait
        
        
        //insert
        Offer::create([
            'photo'=> $file_name,
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'price'=> $request->price,
            'details_ar'=> $request->details_ar,
            'details_en'=> $request->details_en
        ]);
        //$msg = {{__('messages.success')}};
        $msg = $var = Lang::get('messages.success add');
        return redirect()->back()->with(['success add'=> $msg]); //session
    }


    public function getAllOffers(){
        $offers = Offer::select('id','photo','price','name_'.LaravelLocalization::getCurrentLocale().' as name',
        'details_'.LaravelLocalization::getCurrentLocale().' as details')->get();
        foreach($offers as $offer){
            return view('offers.all', compact('offers'));
        }
    }
    public function editOffer($offer_id)
    {
        //$offer = Offer::findOrFail($offer_id); //check id is exist in database or not
        $offer = Offer::find($offer_id); //search on given table id only
        if(!$offer){
            return redirect()->back();
        }else{
            $offer = Offer::select('id','photo','name_ar','name_en','price','details_ar','details_en')->find($offer_id); //find == where
            return view('offers.edit',compact('offer'));
        }
    }
    public function updateOffer(offerRequestUpdate $request, $offer_id){
        //validation request

        //check offer exist
        $offer = Offer::find($offer_id); //find == where
        if(!$offer)
            return redirect()->back();

        //update data

        /* //custome update field
        $offer-> update([
            'name_ar'=> $request-> name_ar,
            'name_en'=>$request-> name_en,
        ]);
        */
        $offer-> update($request->all()); //update all

        $msgUpdate = $var = Lang::get('messages.success update');
        return redirect()->back()->with(['success update'=> $msgUpdate]); //session
    }

    public function delete($offer_id){
        //check if offer id exists
        $offer = Offer::find($offer_id); //Offer::where('id',offer_id)-> first();
        if(!$offer){
            return redirect()->back()->with(['error'=> __('messages.offer not exist')]);
        }else{
        $offer->delete();
            return redirect()
                ->route('offers.all')
                ->with(['successdeleted'=> __('messages.successdeleted')]);
        }
    }
}
