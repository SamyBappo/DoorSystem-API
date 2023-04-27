<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LogCtrl extends Controller
{
    public function add(Request $req){
        try{
            $req->validate([
                'cardUid' => ['required', 'string', 'min:3', 'max:100'],
                'doorId' => ['required', 'string', 'min:3', 'max:100'],
            ]);
        }catch(ValidationException $err){return $err->getMessage(); }
        
        Log::create([
                'cardUid' => $req->cardUid,
                'doorId' => $req->doorId
            ]);
    }

    public function getAll(){ return Log::all(); }

    public function getPastWeek(){ return Log::where('created_at', '>=', now()->subWeek())->get(); }

    public function getPastMonth(){ return Log::where('created_at', '>=', now()->subMonth())->get(); }

    public function getPastYear(){ return Log::where('created_at', '>=', now()->subYear())->get(); }
}
