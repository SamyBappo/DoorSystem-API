<?php

namespace App\Http\Controllers;

use App\Models\Access;
use App\Models\Door;
use App\Models\Log;
use App\Models\RfidCard;
use Error;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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

        Access::create([
            'cardId' => $card->id,
            'doorId' => $door->id,
        ]);
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

        $access = Access::where('cardId', $card->id)->where('doorId', $door->id)->first();
        $access->delete();
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
        $access = Access::where('cardId', $card->id)->where('doorId', $door->id)->first();

        if (!$access){
            Log::create([
                'cardId' => $card->id,
                'doorId' => $door->id,
                'accessGranted' => false,
            ]);
            return false;
        }

        Log::create([
            'cardId' => $card->id,
            'doorId' => $door->id,
            'accessGranted' => true,
        ]);
        return true;
    }
}