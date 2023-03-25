<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use App\Models\Pharmacy; 
use App\Models\Medicine;
use Illuminate\Support\Facades\DB; 

class PharmacyController extends Controller
{
    public function AddPharmacy(Request $request){

        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename = time().'.'.$extension;
        $file->move('Images/Pharmacies', $filename);
        $fileLocation = 'Images/Pharmacies/'.$filename;

        /////////////////////////////////////////////////////
        $offers = $request->file('offers');
        $offers_extension = $offers->getClientOriginalExtension();
        $offers_filename = time().'.'.$offers_extension;
        $offers->move('Images/Pharmacies/Offers', $offers_filename);
        $offers_fileLocation = 'Images/Pharmacies/Offers/'.$offers_filename;


        $data = Pharmacy::create([
            "name" => $request['name'],
            "image" => $fileLocation,
            "address" => $request['address'],
            "location" => $request['location'],
            "times" => $request['times'],
            "phone_number" => $request['phone_number'],
            "rate" => $request['rate'],
            "offers" => $offers_fileLocation
            
            ]
        );


        return response($data, 201);
    }  
     

     
     
    public function UpdatePharmacy(Request $request){
        $pharmacy_name = $request['pharmacy_name'];
        $update_field = $request['update_field'];
        $value = $request['value'];

        DB::table('pharmacies')->where('name',$pharmacy_name)->update([$update_field => $value]);
        
    
            return response($update_field ." = ".$value, 201);
   
    } 
     
     
    public function DeletePharmacy(Request $request){
        $pharmacy_name = $request['pharmacy_name'];

        DB::table('pharmacies')->where('name',$pharmacy_name)->delete();

        return response('Deleted Successfuly',201);
    }

    public function SelectPharmacy($pharmacy_name){
        
        $data = DB::table('pharmacies')->where('name', $pharmacy_name)->get();

        if(!empty($data)){
            foreach($data as $inside => $keyInside){
               $image = $keyInside->{'image'};
               $keyInside->{'image'} = asset($image);
           }  
        }


        //return response($data,201);

        $response = [
            'status' => TRUE,
            'data' => $data
         ];
         return response($response,201);

    } 



    public function SelectAllPharmacies(){
        $data = Pharmacy::get();

        foreach($data as $inside => $keyInside){
            $image = $keyInside->{'image'};
            $keyInside->{'image'} = asset($image);
        }  

        return response($data , 201);
     }


    
   ///////////////////////////////////////////////////////////////////////////////////////////



   public function AddMedicine(Request $request){

    $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename = time().'.'.$extension;
        $file->move('Images/Medicines', $filename);
        $fileLocation = 'Images/Medicines/'.$filename;

    $data = Medicine::create([
        "name" => $request['name'],
        "image" => $fileLocation,
        "size" => $request['size'],
        "effect_material" => $request['effect_material'],
        "price" => $request['price'],
        "side_effects" => $request['side_effects'],  
        "section" => $request['section'],
        "description" => $request['description'],
        "how_to_use" => $request['how_to_use'],
        
        ]
    );

    return response($data, 201);
}

public function DeleteMedicine(Request $request){
    $medicine_name = $request['medicine_name'];

    Medicine::where('name',$medicine_name)->delete();

    return response('Deleted Successfuly',201);
}

public function SelectMedicine($medicine_name){
    $data = Medicine::where('name', $medicine_name)->get();

    if(!empty($data)){
        foreach($data as $inside => $keyInside){
           $image = $keyInside->{'image'};
           $keyInside->{'image'} = asset($image);
       }  
    }

    //return response($data, 201);

    $response = [
        'status' => TRUE,
        'data' => $data
     ];
     return response($response,201);
}


public function SelectAllMedicines(){
    $data = Medicine::get();

    foreach($data as $inside => $keyInside){
        $image = $keyInside->{'image'};
        $keyInside->{'image'} = asset($image);
    }  

    return response($data , 201);
 }
 
}
