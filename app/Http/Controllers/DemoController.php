<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Demo;
use Illuminate\Support\Facades\DB;



class DemoController extends Controller
{
    public function Add(Request $request){
        DB::table('demo')->add([
            'name' => $request['name']
        ]);
    }
}
