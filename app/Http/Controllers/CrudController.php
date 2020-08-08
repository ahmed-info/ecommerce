<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CrudController extends Controller
{
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

    public function store(Request $request)
    {
        //validate data before insert database
        $rules = $this->getRules();
        $messages = $this-> getMessages();
        $validator = Validator::make($request->all(), $rules, $messages);

    if($validator->fails()){
        //return $validator->errors()->first();
        return redirect()->back()->withErrors($validator)->withInput($request->all());
    }
        //insert
        Offer::create([
            'name' => $request->name,
            'price'=> $request->price,
            'details'=> $request->details
        ]);
        return redirect()->back()->with(['success'=>'تم اضافة العرض بنجاح']); //session
    }

    protected function getRules()
    {
        return $rule = [
            //role
            'name'=> 'required|max:100|unique:offers,name',
            'price'=> 'required|numeric',
            'details'=>'required'
        ];
    }

    protected function getMessages(){
        return $message = [
            'name.required' =>__('messages.offer name required'),
            'name.max'=>__('messages.offer name count characters'),
            'name.unique'=>__('messages.offer name is exist'),
            'price.required'=>__('messages.offer price is required'),
            'price.numeric'=>__('messages.offer price must be number'),
            'details.required'=> __('messages.offer details is required')
        ];
    }
}
