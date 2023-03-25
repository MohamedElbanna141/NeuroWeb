<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aid;

class AidController extends Controller
{
    public function AddVideo(Request $request){
        $file = $request->file('video');
        $extension = $file->getClientOriginalExtension();
        $filename = time().'.'.$extension;
        $file->move('Images/First_Aid', $filename);
        $fileLocation = 'Images/First_Aid/'.$filename;

        $data = Aid::create([
            "video" => $fileLocation  
        ]);

        return response('Added Successfully',201);
    }

    public function DeleteVideo(Request $request){
        $video_id = $request['video_id']; 
        Aid::where('id',$video_id)->delete();
        return response('Deleted Successfully', 201);
    }


    public function SelectVideo($video_id){
            
        $data = Aid::where('id',$video_id)->get();
          if(!empty($data)){
              foreach($data as $inside => $keyInside){
                 $video = $keyInside->{'video'};
                 $keyInside->{'video'} = asset($video);
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


     public function SelectAllVideos(){
        $data = Aid::get();
        if(!empty($data)){
            foreach($data as $inside => $keyInside){
               $video = $keyInside->{'video'};
               $keyInside->{'video'} = asset($video);
           } 
        }
        return response($data , 201);
     }
}
