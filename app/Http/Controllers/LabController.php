<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;  
use App\Models\Lab;
use Illuminate\Support\Facades\DB; 

class LabController extends Controller
{
    public function AddLab(Request $request){

        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename = time().'.'.$extension;
        $file->move('Images/Labs', $filename);
        $fileLocation = 'Images/Labs/'.$filename;


        $data = Lab::create([
            "name" => $request['name'],
            "location" => $request['location'],
            "times" => $request['times'],
            "rate" => $request['rate'],
            "phone_number" => $request['phone_number'],
            "image" => $fileLocation
            ]
        );

        return response('Added Successfully', 201);
    }
 
     
     
     
    public function UpdateLab(Request $request){
        $lab_name = $request['lab_name'];
        $update_field = $request['update_field'];
        $value = $request['value'];

        DB::table('labs')->where('name',$lab_name)->update([$update_field => $value]);
        
    
            return response($update_field ." = ".$value, 201);
   
    }  
    public function DeleteLab(Request $request){
        $lab_name = $request['lab_name'];

        DB::table('labs')->where('name',$lab_name)->delete();

        return response('Deleted Successfuly',201);
    }

    public function SelectLab($lab_name){
            
        $data = DB::table('labs')->where('name',$lab_name)->get();
         if(!empty($data)){
             //return response($data , 201);

             foreach($data as $inside => $keyInside){
                $image = $keyInside->{'image'};
                $keyInside->{'image'} = asset($image);
            }  

             $response = [
                'status' => TRUE,
                'data' => $data
             ];
             return response($response,201);
         }else{
             return response('Data Not Found' , 201);
         }
     }

     public function SelectLabByName($word){
        $data = Lab::where('name', 'LIKE', "%$word%")->get();

        foreach($data as $inside => $keyInside){
            $image = $keyInside->{'image'};
            $keyInside->{'image'} = asset($image);
        }  

        return response($data , 201);
    }

    public function SelectAllLabs(){
        $data = Lab::get();

        foreach($data as $inside => $keyInside){
            $image = $keyInside->{'image'};
            $keyInside->{'image'} = asset($image);
        }  

        return response($data , 201);
     }

}


