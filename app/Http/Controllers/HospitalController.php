<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hospital;
use Illuminate\Support\Facades\DB;

class HospitalController extends Controller
{
    public function AddHospital(Request $request){

        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename = time().'.'.$extension;
        $file->move('Images/Hospitals', $filename);
        $fileLocation = 'Images/Hospitals/'.$filename;

        $data = Hospital::create([
            "name" => $request['name'],
            "address" => $request['address'],
            "location" => $request['location'],
            "sections" => $request['sections'],
            "rate" => $request['rate'],
            "schedule" => $request['schedule'],
            "emergency_schedule" => $request['emergency_schedule'],
            "phone_number" => $request['phone_number'],
            "image" => $fileLocation
            ]
        );

        return response($data, 201);
    }


    public function UpdateHospital(Request $request){
        $hospital_name = $request['hospital_name'];
        $update_field = $request['update_field'];
        $value = $request['value'];

        DB::table('hospitals')->where('name',$hospital_name)->update([$update_field => $value]);
        $newData = DB::table('hospitals')->where('name',$hospital_name)->select($update_field)->get();
    
            return response($update_field ." = ".$value, 201);
   
    }


    public function DeleteHospital(Request $request){
        $hospital_name = $request['hospital_name'];

        DB::table('hospitals')->where('name',$hospital_name)->delete();

        return response('Deleted Successfuly',201);
    }

    public function SelectHospital($hospital_name){
        
        $data = DB::table('hospitals')->where('name', $hospital_name)->get();

        //return response($data,201);

        $response = [
            'status' => TRUE,
            'data' => $data
         ];
         return response($response,201);

    }

    public function SelectHospitalByName($word){
        $data = Hospital::where('name', 'LIKE', "%$word%")->get();

        if(!empty($data)){
            foreach($data as $inside => $keyInside){
               $image = $keyInside->{'image'};
               $keyInside->{'image'} = asset($image);
            }
        }
        return response($data , 201);
    }

    public function SelectAllHospitals(){
        $data = Hospital::get();

        if(!empty($data)){
            foreach($data as $inside => $keyInside){
               $image = $keyInside->{'image'};
               $keyInside->{'image'} = asset($image);
            }
        }

        return response($data , 201);
     }

     
}
