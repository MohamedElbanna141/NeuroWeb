<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alert;

class AlertController extends Controller
{
    public function AddAlert(Request $request){
        Alert::create([
            "color" => $request['color'],
            "category" => $request['category'],
            "title" => $request['title'],
            "description" => $request['description'],
            "date" => $request['date'],
            "time" => $request['time'],
            "user_id" => $request['user_id']
        ]);

        return response("Added Successfully", 201);
    }

    public function UpdateAlert(Request $request){
        $alert_title = $request['alert_title'];
        $update_field = $request['update_field'];
        $value = $request['value'];
            Alert::where('title',$alert_title)->update([$update_field=>$value]);
            $newValue = Alert::where('title',$request['alert_title'])->select($update_field)->get();

            foreach($newValue as $idex => $key){
                foreach($key as $key1 => $value1)
                    
                    if($value == $value1){
                
                        return response($newValue, 201);
                    }else{
                        return response('Try Again', 201);
                    }

            }

            
        }       


        public function DeleteAlert(Request $request){
            $alert_title = $request['alert_title']; 
            Alert::where('title',$alert_title)->delete();
            return response('Deleted Successfully', 201);
        }


        public function SelectAlert($alert_title){
           $data = Alert::where('title','LIKE',"%$alert_title%")->get();
            if(!empty($data)){
                foreach($data as $key => $value){
                    if($value['category'] == "DOCTOR"){
                        $value['image'] = asset("Images/Alerts/doctor.png");
                    }elseif($value['category'] == "MEDICINE"){
                        $value['image'] = asset("Images/Alerts/medicine.png");
                    }elseif($value['category'] == "HOSPITAL"){
                        $value['image'] = asset("Images/Alerts/hospital.png");
                    }elseif($value['category'] == "LAB"){
                        $value['image'] = asset("Images/Alerts/lab.png");
                    }
                }
                return response($data , 201);
            }else{
                return response('Data Not Found' , 201);
            }
        }

        public function SelectAllAlerts($user_id){
            $data = Alert::where('user_id', $user_id)->get();
            if(!empty($data)){
                foreach($data as $key => $value){
                    if($value['category'] == "DOCTOR"){
                        $value['image'] = asset("Images/Alerts/doctor.png");
                    }elseif($value['category'] == "MEDICINE"){
                        $value['image'] = asset("Images/Alerts/medicine.png");
                    }elseif($value['category'] == "HOSPITAL"){
                        $value['image'] = asset("Images/Alerts/hospital.png");
                    }elseif($value['category'] == "LAB"){
                        $value['image'] = asset("Images/Alerts/lab.png");
                    }
                }
                return response($data , 201);
            }else{
                return response('Data Not Found' , 201);
            }
            return response($data , 201);
         }
}
