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

        Door::create([
            'name' => $req->name,
            'location' => $req->location,
            'description' => $req->description,
        ]);
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

        $door = Door::find($req->id);
        $door->name = $req->name;
        $door->description = $req->description;
        $door->location = $req->location;
        $door->save();
    }

    public function delete(Request $req)
    {
        $door = Door::find($req->id);
        $door->delete();
    }

}
