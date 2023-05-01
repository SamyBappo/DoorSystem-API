<?php

namespace App\Http\Controllers;

use App\Models\Door;
use Error;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class DoorCtrl extends Controller
{
    public function getall(){ return Door::all();}
    
    public function add(Request $req)
    {
        try {
            $req->validate([
                'name' => ['required', 'string', 'min:3', 'max:100'],
                'location' => ['required', 'string', 'min:3', 'max:100'],
                'description' => ['required', 'string', 'min:3', 'max:100'],
            ]);
        }catch(ValidationException $err){return $err->getMessage(); }

        if(Door::where('name',$req->name)->first() != null){
            return ("Door already exists!");
        }

        Door::create([
            'name' => $req->name,
            'location' => $req->location,
            'description' => $req->description,
        ]);
        return ("Success!");
    }

    public function update(Request $req)
    {
        try {
            $req->validate([
                'name' => ['required', 'string', 'min:3', 'max:100'],
                'description' => ['required', 'string', 'min:3', 'max:100'],
                'location' => ['required', 'string', 'min:3', 'max:100'],
            ]);
        }catch(ValidationException $err){return $err->getMessage(); }

        $door = Door::where('name',$req->name)->first();
        if($door == null){return ("Door not found!");}
        $door->description = $req->description;
        $door->location = $req->location;
        $door->save();
        return ("Success!");
    }

    public function delete(Request $req)
    {
        try {
            $req->validate([
                'name' => ['required', 'string', 'min:3', 'max:100']
            ]);
        }catch(ValidationException $err){return $err->getMessage(); }
        $door = Door::where('name',$req->name)->first();
        if($door == null){return ("Door not found!");}
        $door->delete();
        return ("Success!");
    }

}
