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
                'doorId' => ['required', 'string', 'min:3', 'max:100'],
            ]);
        }catch(ValidationException $err){return $err->getMessage(); }

        $access = Access::where('cardUid', $req->cardUid)->where('doorId', $req->doorId)->first();
        $access->delete();
    }

    public function check(Request $req)
    {
        try {
            $req->validate([
                'cardUid' => ['required', 'string', 'min:3', 'max:100'],
                'doorId' => ['required', 'string', 'min:3', 'max:100'],
            ]);
        } catch(ValidationException $err){return $err->getMessage(); }

        $access = Access::where('cardUid', $req->cardUid)->where('doorId', $req->doorId)->first();
        if (!$access) return false;
        Log::create([
            'cardUid' => $req->cardUid,
            'doorId' => $req->doorId,
            'status' => 'success'
        ]);
        return true;
    }
}
