<?php

namespace App\Http\Controllers;

use App\Models\rfidCard;
use Illuminate\Http\Request;

class cardCtrl extends Controller
{
    public function getall(){
        return rfidCard::all();
    }

    public function check(Request $req){
        $uid = $req->input('uid');
        $cards = rfidCard::all();
        foreach($cards as $card){
            if ($card->uid == $uid){return $card->accessLvl;}
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