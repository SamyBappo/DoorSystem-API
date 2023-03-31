<?php

namespace App\Http\Controllers;

use App\Models\rfidCard;
use Error;
use Illuminate\Http\Request;
use PhpMqtt\Client\Facades\MQTT;

class cardCtrl extends Controller
{
    public function mqttSub(){
        $mqtt = MQTT::connection();
        $mqtt->subscribe('/door/cardUID', function (string $topic, string $message) {
            }, 1);
        $mqtt->loop(true);
    }

    public function getall(){
        return route('api/card/check',['uid'=>'po'], true);
        $mqtt = MQTT::connection();
        $mqtt->subscribe('/door/cardUID', function (string $topic, string $message) {
                return route('api/card/check',['uid'=>$message]);
            }, 1);
        //$mqtt->loop(true);
        //return rfidCard::all();
    }

    public function checkOld(Request $req){

        $uid = $req->input('uid');
        $cards = rfidCard::all();
        foreach($cards as $card){
            if ($card->uid == $uid)
            {
                MQTT::publish('/door/acsLvl', $card->accessLvl);
                $log = new logCtrl();
                $log->add($uid);
                return $card->accessLvl;
            }
        }
        return 0;
    }

    public function add(Request $req){
        try{ $req->validate([ 'uid'=>['required', 'string',  'min:3', 'max:100']]); }
        catch(Error $err){return [false,'Fill all fields']; }

        $card = new rfidCard();
        $card->uid = $req->uid;
        $card->save();
    }

    public function update(Request $req){
        try{ 
            $req->validate([ 
                'id'=>['required', 'string',  'min:3', 'max:100'],
                'uid'=>['required', 'string',  'min:3', 'max:100']
            ]); 
        }
        catch(Error $err){return [false,'Fill all fields']; }

        $card = rfidCard::find($req->id);
        $card->uid = $req->uid;
        $card->save();
    }

    public function delete(Request $req){
        try{ $req->validate([ 'id'=>['required', 'string',  'min:3', 'max:100']]); }
        catch(Error $err){return [false,'Provide UID']; }
        $card = rfidCard::find($req->id);
        $card->delete();
    }
}