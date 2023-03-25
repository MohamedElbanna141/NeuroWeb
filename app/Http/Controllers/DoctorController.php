<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Doctor;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function AddDoctor(Request $request)
    {
        $fields = $request->validate([
            "first_name" => "required|string",
            "last_name" => "required|string",
            "assistant" => "string",
            "offers" => "string",
            "sections" => "required|string"
        ]);

        $file = $request->file('image');
        $extension = $file->getClientOriginalExtension();
        $filename = time().'.'.$extension;
        $file->move('Images/Doctors', $filename);
        $fileLocation = 'Images/Doctors/'.$filename;

        $doctor = Doctor::create([
            "first_name" => $fields['first_name'],
            "last_name" => $fields['last_name'],
            "assistant" => $fields['assistant'],
            "offers" => $fields['offers'],
            "sections" => $fields['sections'],
            "image" => $fileLocation,
            "price" => $request['price'],
            "phone_number" => $request['phone_number'],
            "about" => $request['about'],
            "schedule" => $request['schedule'],
            "time" => $request['time'],
            "rate" => $request['rate'],
            "address" => $request['address'],
            
        ]);
        return response('Added Successfully', 201);

    }

    public function UpdateDoctor(Request $request){
        $doctor_id = $request['doctor_id'];
        $update_field = $request['update_field'];
        $value = $request['value'];
            DB::table('doctors')->where('id',$doctor_id)->update([$update_field=>$value]);
            $newValue = DB::table('doctors')->where('id',$request['doctor_id'])->select($update_field)->get();

            foreach($newValue as $idex => $key){
                foreach($key as $key1 => $value1)
                    
                    if($value == $value1){
                
                        return response($newValue, 201);
                    }else{
                        return response('Try Again', 201);
                    }

            }

            
        }       


        public function DeleteDoctor(Request $request){
            $doctor_id = $request['doctor_id']; 
            DB::table('doctors')->where('id',$doctor_id)->delete();
            return response('Deleted Successfully', 201);
        }


        public function SelectDoctor($doctor_id){
            
           $data = DB::table('doctors')->where('id',$doctor_id)->get();
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



        public function SelectDoctorBySection($doctor_section){
            
            $data = DB::table('doctors')->where('sections',$doctor_section)->get();
             if(!empty($data)){
                foreach($data as $inside => $keyInside){
                    $image = $keyInside->{'image'};
                    $keyInside->{'image'} = asset($image);
                }
                 //return response($data, 201);
                 $response = [
                    'status' => TRUE,
                    'data' => $data
                 ];
                 return response($response,201);
             }else{
                 return response('Data Not Found' , 201);
             }
             
         }


         public function Search($word){
            $data = Doctor::where('first_name', 'LIKE', "%$word%")
            ->orwhere('last_name', 'LIKE', "%$word%")
            ->orwhere('assistant', 'LIKE', "%$word%")
            ->orwhere('offers', 'LIKE', "%$word%")
            ->orwhere('sections', 'LIKE', "%$word%")
            ->orwhere('price', 'LIKE', "%$word%")
            ->orwhere('phone_number', 'LIKE', "%$word%")
            ->orwhere('about', 'LIKE', "%$word%")
            ->orwhere('schedule', 'LIKE', "%$word%")
            ->orwhere('rate', 'LIKE', "%$word%")
            ->orwhere('address', 'LIKE', "%$word%")
            ->get();
            return response($data , 201);
         }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Doctor $doctor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        //
    }
}
