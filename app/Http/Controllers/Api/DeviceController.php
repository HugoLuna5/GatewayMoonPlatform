<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Device;
use App\Models\Token;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class DeviceController extends Controller
{
    public $successStatus = 200;


    public function createDevice(Request $request){


        $validator = Validator::make(request()->all(), [
            'device_token' => 'required',
            'device_name' => 'required',
            'phone_number' => 'required',
            'region' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error' ,'message'=>$validator->errors()], $this->successStatus);
        }

        $request['user_id'] = Auth::user()->id;
        $device = Device::create($request->all());
        if ($device != null){
            return response()->json(['status' => 'success' ,'message'=>'Dispositivo agregado con exito.', 'device_id' => $device->id], $this->successStatus);

        }
        return response()->json(['status' => 'error' ,'message'=> 'Error al agregar el dispositivo'], $this->successStatus);

    }

}
