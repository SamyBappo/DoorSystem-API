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

    public function getAll(){
        return Log::join('Doors', 'Logs.doorId', '=', 'Doors.id')
            ->join('RfidCards', 'Logs.cardId', '=', 'RfidCards.id')
            ->select('Doors.name as doorName', 'RfidCards.uid as cardUid', 'Logs.created_at as time', 'Logs.accessGranted')
            ->get();
    }

    public function getPastWeek(){
        return Log::join('Doors', 'Logs.doorId', '=', 'Doors.id')
            ->join('RfidCards', 'Logs.cardId', '=', 'RfidCards.uid')
            ->select('Doors.name as doorName', 'RfidCards.uid as cardUid', 'Logs.created_at as time', 'Logs.accessGranted')
            ->where('logs.created_at', '>=', now()->subWeek())
            ->get();
    }

    public function getPastMonth(){
        return Log::join('Doors', 'Logs.doorId', '=', 'Doors.id')
            ->join('RfidCards', 'Logs.cardId', '=', 'RfidCards.uid')
            ->select('Doors.name as doorName', 'RfidCards.uid as cardUid', 'Logs.created_at as time', 'Logs.accessGranted')
            ->where('logs.created_at', '>=', now()->subMonth())
            ->get();
    }

    public function getPastYear(){
        return Log::join('Doors', 'Logs.doorId', '=', 'Doors.id')
            ->join('RfidCards', 'Logs.cardId', '=', 'RfidCards.uid')
            ->select('Doors.name as doorName', 'RfidCards.uid as cardUid', 'Logs.created_at as time', 'Logs.accessGranted')
            ->where('logs.created_at', '>=', now()->subYear())
            ->get();
    }
}
