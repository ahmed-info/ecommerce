<?php

namespace App\Http\Controllers\Relation;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Patient;
use App\Models\Phone;
use App\Models\Service;
use App\User;
use Illuminate\Http\Request;

class RelationsController extends Controller
{
    public function hasOneRelation(){
        //$user = User::find(2);                     //tabel primary

        //return response()->json($user);         get data tabele primary key
        //return $user->phone;                    //get data table foreign key


         $user = User::with('phone')->find(2);   // get data two tables
         $phone = $user->phone;                  //tabel primary
         //return $phone->code;                     part table primary

         //or
         $user = User::with(['phone' => function($q){
             $q->select('code','phone','user_id');
         }])->find(2);
        return $user-> phone-> code; //get part of all tables 
         return response()->json($user);
    }

    public function hasOneRelationReverse()
    {
        $phone = Phone::find(1);
        //return $phone;

        //make some attribute visible
         $phone-> makeVisible(['user_id']);
        //$phone-> makeHidden(['code']);
        //return $phone -> user;
        //get all user & phone

        //$allData = Phone::with('user')->find(1);
        //return $allData;

        $dataselect = Phone::with(['user' => function($qq){
            $qq-> select('name','id');
        }])->find(1);
        return $dataselect;
    }

    public function getUserHasPhone(){
        return User::whereHas('phone')->get();
       
    }

    public function getUserNotHasPhone(){
        $user= User::whereDoesntHave('phone')->get();
        return $user;
    }

    public function getUserWhereHasPhoneWithCondition(){
        return User::whereHas('phone', function($qq){
            $qq->where('age','14');
        })->get();
    }
    ################### Begin One to many relationships ##################
    
    public function getHospitalDoctors(){
        $hospital = Hospital::find(1); // Hospital::where('id',1)->first(); // Hospital::first();
        // return $hospital->doctors; //return hospital doctors
        $hospital = Hospital::with('doctors')->find(1);
        //return $hospital; //hospital with doctors
        //return $hospital->name;
        $doctors = $hospital->doctors;
        
        /*foreach($doctors as $doctor){
            echo $doctor->name .'<br>';
        }*/
        
        $doctor = Doctor::find(3);
        return $doctor->hospital->name;

    }

    public function hospitals(){
        $hospitals = Hospital::select('id','name','address')->get();
        return view('doctors.hospitals', compact('hospitals'));
    }

    public function doctors($hospital_id){
        $hospital = Hospital::find($hospital_id);
        $doctors = $hospital-> doctors;
        return view('doctors.doctors', compact('doctors'));
    }

    public function deleteHospital($hospital_id){

        $hospital = Hospital::find($hospital_id);
        if(!$hospital)
            return abort('404'); // page not found
        if(isset($hospital->doctors) && $hospital->doctors->count() > 0){
            $hospital->doctors()->delete();
        }
        $hospital->delete();
        return redirect()->back()->with(['successDeleted'=> 'تم حذف المستشفى بنجاح']);
    }

        //get all hospital which must has doctors
    public function hospitalsHasDoctor(){
        return $hospitals = Hospital::whereHas('doctors')->get();
    }

    public function hospitalsHasOnlyMaleDoctors(){
        
        $hospitals = Hospital::with('doctors')->whereHas('doctors', function ($q) {
            $q->where('gender', 2);
        })->get();

        return $hospitals;

    }

    public function hospitals_not_has_doctors(){
        $hospitals = Hospital::whereDoesntHave('doctors')->get();
        return $hospitals;
    }
    ################### End One to many relationships ##################
    ################### Begin many to many relationships ###############
    public function getDoctorServices(){
        //$doctor = Doctor::find(3);
         $doctor = Doctor::with('services')->find(4);
         $services =  $doctor -> services;
        
        foreach($services as $service){
            echo $service-> name.'<br>';
        }
        
    }

    public function getServiceDoctors(){
        //return $doctors = Service::with('doctors')->find(1);
        $doctors = Service::with(['doctors' => function($query){
            $query->select('doctors.id','name','title');
        }])->find(1);

        return $doctors;
    }
    public function getDoctorServicesById($doctor_id)
    {
        $doctor = Doctor::find($doctor_id);
        $services = $doctor-> services; //doctor services

        $doctors = Doctor::select('id','name')->get();
        $allServices = Service::select('id','name')->get(); //all services BD

        return view('doctors.services', compact('services','doctors', 'allServices'));
    }

    public function saveServicesToDoctors(Request $request){
        $doctor = Doctor::with('services')->find($request->doctor_id);
        if(!$doctor)
            return abort('404');

        //update
        //$doctor->services()-> attach($request->servicesIds); //many to many insert DB add with duplication
        //$doctor->services()-> sync($request->servicesIds); //delete old and add new without duplication
        $doctor->services()-> syncWithoutDetaching($request->servicesIds); //dont delete old and add new without duplication

        return 'success';
    }
    ################### End many to many relationships ###############

    #################### Begin has one through #######################
    public function getPatientDoctor(){
        $patient = Patient::find(2);
        return $patient->doctor;
    }
    public function getCountryDoctor()
    {
        //return $country = Country::with('hospitals')->find(2);
        //return $country = Country::with('doctors')->find(2);
        $country = Country::find(2);
        return $country->doctors;
    }
    #################### End has one through #######################
    public function getDoctors()
    {
        return $doctors = Doctor::select('id','name','gender')->get();
      /*  if(isset($doctors) && $doctors->count() > 0)
            foreach($doctors as $doctor){
             $doctor->gender = $doctor->gender ==1 ? 'male':'female';         //$doctor->newVal = 'new';
            }
        return $doctors; */
    }
}
