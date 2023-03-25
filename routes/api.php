<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\LabController;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\AlertController;
use App\Http\Controllers\InstructionController;
use App\Http\Controllers\AidController;



////////////////////////////////////////////////
use App\Http\Controllers\DemoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('posts', [PostController::class,'index']);


Route::post('register_one', [AuthController::class,'register_one']);
Route::post('login_one', [AuthController::class,'login_one']);

//////////////// Doctors ////////////////////
Route::post('AddDoctor', [DoctorController::class,'AddDoctor']);
Route::put('UpdateDoctor', [DoctorController::class,'UpdateDoctor']);
Route::post('DeleteDoctor', [DoctorController::class,'DeleteDoctor']);
Route::get('SelectDoctor/{doctor_id}', [DoctorController::class,'SelectDoctor']);
Route::get('SelectDoctorBySection/{doctor_section}', [DoctorController::class,'SelectDoctorBySection']);
////////////////////////Search/////////////////////
Route::get('Search/{word}',[DoctorController::class, 'Search']);





/////////////// Hospital //////////////////
Route::post('AddHospital',[HospitalController::class, 'AddHospital']);
Route::put('UpdateHospital',[HospitalController::class, 'UpdateHospital']);
Route::post('DeleteHospital',[HospitalController::class,'DeleteHospital']);

Route::get('SelectHospital/{hospital_name}',[HospitalController::class,'SelectHospital']); 
Route::get('SelectHospitalByName/{word}',[HospitalController::class, 'SelectHospitalByName']);
Route::get('SelectAllHospitals',[HospitalController::class, 'SelectAllHospitals']);
 
 
 
///////////////////Pharmacy/////////////////////////////// 
 
 
 
Route::post('AddPharmacy',[PharmacyController::class, 'AddPharmacy']);  
Route::put('UpdatePharmacy',[PharmacyController::class, 'UpdatePharmacy']); 
Route::post('DeletePharmacy',[PharmacyController::class,'DeletePharmacy']);
Route::get('SelectPharmacy/{pharmacy_name}',[PharmacyController::class,'SelectPharmacy']);
Route::get('SelectAllPharmacies',[PharmacyController::class,'SelectAllPharmacies']);

///////////////////Medicine/////////////////////////////// 


Route::post('AddMedicine',[PharmacyController::class, 'AddMedicine']); 
Route::post('DeleteMedicine',[PharmacyController::class, 'DeleteMedicine']); 
Route::get('SelectMedicine/{medicine_name}',[PharmacyController::class,'SelectMedicine']);  
Route::get('SelectAllMedicines',[PharmacyController::class,'SelectAllMedicines']);  


 
 
////////////////////Labs///////////////////////   
 
 

Route::post('AddLab',[LabController::class, 'AddLab']); 
Route::put('UpdateLab',[LabController::class, 'UpdateLab']); 
Route::post('DeleteLab',[LabController::class,'DeleteLab']);
 
Route::get('SelectLab/{lab_name}',[LabController::class,'SelectLab']);  

Route::get('SelectLabByName/{word}',[LabController::class, 'SelectLabByName']);
Route::get('SelectAllLabs',[LabController::class, 'SelectAllLabs']);


 




/////////////////////////demo/////////////////////////
Route::post('Add',[DemoController::class,'Add']);


////////////////////////Alerts////////////////////////
Route::post('AddAlert',[AlertController::class,'AddAlert']);
Route::put('UpdateAlert',[AlertController::class,'UpdateAlert']);
Route::post('DeleteAlert',[AlertController::class,'DeleteAlert']);
Route::get('SelectAlert/{alert_title}',[AlertController::class,'SelectAlert']);
Route::get('SelectAllAlerts/{user_id}',[AlertController::class,'SelectAllAlerts']);

////////////////////////Instructions///////////////////
Route::post('AddInstruction',[InstructionController::class,'AddInstruction']);
Route::get('SelectInstruction/{instruction_id}',[InstructionController::class,'SelectInstruction']);
Route::get('SelectAllInstructions',[InstructionController::class,'SelectAllInstructions']);



//////////////////////////First Aid////////////////////////////////

Route::post('AddVideo',[AidController::class,'AddVideo']);
Route::post('DeleteVideo',[AidController::class,'DeleteVideo']);
Route::get('SelectVideo/{Video_id}',[AidController::class,'SelectVideo']);
Route::get('SelectAllVideos',[AidController::class,'SelectAllVideos']);



/////////////////////////////////////////////////////////////
//Route::post('register', [AuthController::class,'register']);
//Route::post('login', [AuthController::class,'login']);


/* JUST TESTING API  */

Route::get('test',function(){
    return 'API works';
});

/*............................................... */

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
