<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Kreait\Firebase\Messaging\CloudMessage;


class HomeController extends Controller
{


    /**
     * HomeController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $user = Auth::user();
        $devices = Device::where('user_id', '=', $user->id)->paginate(20);
        return view('home.index', compact('devices'));
    }

    /**
     * Send message test from platform
     * @param $device_id
     * @return string|void
     */
    public function sendMessageTest($device_id){

        $device = Device::find($device_id);

        if ($device != null){
            $messaging = app('firebase.messaging');


            $message = CloudMessage::fromArray([
                'token' => $device->device_token,
                'notification' => [
                    'title' => 'Nuevo mensaje',
                    'body' => 'Hola mundo'
                ], // optional
                'data' => [
                    'phone' => '+527891005104',
                    'message' => 'Hola XD'
                ], // optional
            ]);

            $messaging->send($message);

            return "Hello";

        }
        return abort(404);

    }


    public function sendMessageView(){
        $user = Auth::user();
        $devices = Device::where('user_id', '=', $user->id)->paginate(20);
        return view('home.messages.send', compact('devices'));
    }

    public function sendMessage(Request $request){
        $validator = Validator::make($request->all(),[
            'device_id' => ['required'],
            'phone' => ['required'],
            'message' => ['required'],

        ]);

        if ($validator->fails()) {
            $notification = array(
                'message' => 'Todos los datos son requeridos: '.$validator->errors(),
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
        $user = Auth::user();
        $device = null;
        if ($request->device_id == 'random'){
            $device = Device::where('user_id', '=', $user->id)->inRandomOrder()->first();
        }else{
            $device = Device::find($request->device_id);
        }



        if ($device != null){
            $messaging = app('firebase.messaging');


            $message = CloudMessage::fromArray([
                'token' => $device->device_token,
                'notification' => [
                    'title' => 'Nuevo mensaje',
                    'body' => 'Se ha enviado un mensaje ha '.$request->phone
                ], // optional
                'data' => [
                    'phone' => $request->phone,
                    'message' => $request->message
                ], // optional
            ]);

            $request['device_id'] = $device->id;
            $request['type'] = 'remit';
            $newMessage = Message::create($request->all());

            $messaging->send($message);

            $notification = array(
                'message' => '¡Mensaje enviado exitosamente!',
                'alert-type' => 'success'
            );
            return back()->with($notification);

        }

    }

}
