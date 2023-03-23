<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class logCtrl extends Controller
{
    public function add($cardUid){
        $log = new Log();
        $log->cardUid=$cardUid;
        $log->save();
    }

    public function getAll(){
        return Log::all();
    }

    public function getPastWeek(){
        return Log::where('created_at', '>=', now()->subWeek())->get();
    }

    public function getPastMonth(){
        return Log::where('created_at', '>=', now()->subMonth())->get();
    }

    public function getPastYear(){
        return Log::where('created_at', '>=', now()->subYear())->get();
    }
}
