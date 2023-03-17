<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class logCtrl extends Controller
{
    public function add(Request $req){
        $log = new Log();
        $log->cardUid=$req->cardUid;
        $log->save();
    }

    public function getAll(){
        return Log::all();
    }
}
