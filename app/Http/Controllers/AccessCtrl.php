<?php

namespace App\Http\Controllers;

use App\Models\Access;
use Error;
use Illuminate\Http\Request;

class AccessCtrl extends Controller
{
    public function add(Request $req)
    {
        try {
            $req->validate([
                'cardUid' => ['required', 'string', 'min:3', 'max:100'],
                'doorId' => ['required', 'string', 'min:3', 'max:100'],
            ]);
        } catch (Error $err) { return [false, 'Fill all fields']; }

        $access = new Access();
        $access->cardUid = $req->cardUid;
        $access->doorId = $req->doorId;
        $access->save();
    }

    public function delete(Request $req)
    {
        try {
            $req->validate([
                'cardUid' => ['required', 'string', 'min:3', 'max:100'],
                'doorId' => ['required', 'string', 'min:3', 'max:100'],
            ]);
        } catch (Error $err) { return [false, 'Fill all fields']; }

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
        } catch (Error $err) { return [false, 'Fill all fields']; }

        $access = Access::where('cardUid', $req->cardUid)->where('doorId', $req->doorId)->first();
        if ($access) return [true, 'Access granted'];
        else return [false, 'Access denied'];
    }
}
