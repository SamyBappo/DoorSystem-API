<?php

namespace App\Http\Controllers;

use App\Models\RfidCard;
use Error;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use PhpMqtt\Client\Facades\MQTT;

class CardCtrl extends Controller
{
    public function getall(){
        return RfidCard::all();
    }
    
    public function add(Request $req){
        try{ $req->validate([ 'uid'=>['required', 'string',  'min:3', 'max:100']]); }
        catch(ValidationException $err){return $err->getMessage(); }

        RfidCard::create(['uid'=>$req->uid]);
    }

    public function update(Request $req){
        try{ 
            $req->validate([ 
                'id'=>['required', 'string',  'min:3', 'max:100'],
                'uid'=>['required', 'string',  'min:3', 'max:100']
            ]); 
        }catch(ValidationException $err){return $err->getMessage(); }

        $card = RfidCard::find($req->id);
        $card->uid = $req->uid;
        $card->save();
    }

    public function delete(Request $req){
        try{ $req->validate([ 'id'=>['required', 'string',  'min:3', 'max:100']]); }
        catch(ValidationException $err){return $err->getMessage(); }
        $card = RfidCard::find($req->id);
        $card->delete();
    }

    // public function checkOld(Request $req){
    //     $uid = $req->input('uid');
    //     $cards = RfidCard::all();
    //     foreach($cards as $card){
    //         if ($card->uid == $uid)
    //         {
    //             MQTT::publish('/door/acsLvl', $card->accessLvl);
    //             $log = new logCtrl();
    //             $log->add($uid);
    //             return $card->accessLvl;
    //         }
    //     }
    //     return 0;
    // }

}