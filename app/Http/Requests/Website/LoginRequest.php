<?php
namespace App\Http\Requests\Website;

use App\Traits\ApiTrait;
use App\Traits\GeneralTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginRequest extends FormRequest {
    // use ApiTrait, GeneralTrait;

    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'name' => ['required','string','max:512'],
            'phone'=>['required'],
            'password' => ['required|confirmed|min:8'], 
            'password_confirmation' => ['required'],
            
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator$validator) {
        $msg = $validator->errors()->first();
        throw new HttpResponseException(response()->json(['key' => 'fail', 'msg' => $msg]));
    }
}