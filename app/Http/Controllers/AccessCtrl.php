<?php

namespace App\Http\Controllers;

use App\Models\Access;
use App\Models\Door;
use App\Models\Log;
use App\Models\RfidCard;
use Error;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use PhpMqtt\Client\Facades\MQTT;

class AccessCtrl extends Controller
{
    public function add(Request $req)
    {
        try {
            $req->validate([
                'cardUid' => ['required', 'string', 'min:3', 'max:100'],
                'doorName' => ['required', 'string', 'min:3', 'max:100'],
            ]);
        }catch(ValidationException $err){return $err->getMessage(); }

        $card = RfidCard::where('uid', $req->cardUid)->first();
        $door = Door::where('name', $req->doorName)->first();

        if($card==null or $door==null){
            return ("card or door unknown");
        }

        if(Access::where('cardId', $card->id)->where('doorId', $door->id)->first() != null){
            return ("Access exists already!");
        }

        Access::create([
            'cardId' => $card->id,
            'doorId' => $door->id,
        ]);
        return("Success!");
    }

    public function delete(Request $req)
    {
        try {
            $req->validate([
                'cardUid' => ['required', 'string', 'min:3', 'max:100'],
                'doorName' => ['required', 'string', 'min:3', 'max:100'],
            ]);
        }catch(ValidationException $err){return $err->getMessage(); }

        $card = RfidCard::where('uid', $req->cardUid)->first();
        $door = Door::where('name', $req->doorName)->first();
        if($card==null or $door==null){return ("Access not found!");}

        $access = Access::where('cardId', $card->id)->where('doorId', $door->id)->first();
        if($access == null){return ("Access not found!");}
        $access->delete();
        return("Success!");
    }

    public function check(Request $req)
    {
        try {
            $req->validate([
                'cardUid' => ['required', 'string', 'min:3', 'max:100'],
                'doorName' => ['required', 'string', 'min:3', 'max:100'],
            ]);
        }catch(ValidationException $err){return $err->getMessage(); }

        $card = RfidCard::where('uid', $req->cardUid)->first();
        $door = Door::where('name', $req->doorName)->first();
        if($card==null or $door==null){return ("Access not found!");}
        $access = Access::where('cardId', $card->id)->where('doorId', $door->id)->first();

        if ($access==null){
            Log::create([
                'cardId' => $card->id,
                'doorId' => $door->id,
                'accessGranted' => false,
            ]);
            return 0;
        }

	MQTT::connection()
    	->setAuth(env('MQTT_USERNAME'), env('MQTT_PASSWORD'));
        MQTT::connection()->publish('/DoorSystem/door/open', $door->name);
        Log::create([
            'cardId' => $card->id,
            'doorId' => $door->id,
            'accessGranted' => true,
        ]);
        return 1;
    }

    public function getAll(){
        return Access::all();
    }
}
