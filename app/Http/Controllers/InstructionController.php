<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Instruction;


class InstructionController extends Controller
{
    public function AddInstruction(Request $request){
        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename = time().'.'.$extension;
        $file->move('Images/Instructions', $filename);
        $fileLocation = 'Images/Instructions/'.$filename;

        $data = Instruction::create([
            "name" => $request['name'],
            "image" => $fileLocation  
        ]);

        return response('Added Successfully',201);


    }



    public function SelectInstruction($instruction_id){
            
        $data = DB::table('instructions')->where('id',$instruction_id)->get();
          if(!empty($data)){
              foreach($data as $inside => $keyInside){
                 $image = $keyInside->{'image'};
                 $keyInside->{'image'} = asset($image);
             }  

             
             //return response($data , 201);

             $response = [
                 'status' => TRUE,
                 'data' => $data
              ];
              return response($response,201);
         }else{
             return response('Data Not Found' , 201);
         }
     }



    public function SelectAllInstructions(){
        $data = Instruction::get();
        if(!empty($data)){
            foreach($data as $inside => $keyInside){
               $image = $keyInside->{'image'};
               $keyInside->{'image'} = asset($image);
           } 
        }
        return response($data , 201);
     }

}
