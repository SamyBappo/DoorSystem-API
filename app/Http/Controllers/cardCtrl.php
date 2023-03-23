<?php

namespace App\Http\Controllers;

use App\Models\rfidCard;
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

    public function check(Request $req){

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
        $card = new rfidCard();
        $card->uid = $req->uid;
        $card->accessLvl = $req->accessLvl;

        $card->save();
        return 0;
    }


}