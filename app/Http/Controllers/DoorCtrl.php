<?php

namespace App\Http\Controllers;

use App\Models\Door;
use Error;
use Illuminate\Http\Request;

class DoorCtrl extends Controller
{
    public function add(Request $req)
    {
        try {
            $req->validate([
                'name' => ['required', 'string', 'min:3', 'max:100'],
                'description' => ['required', 'string', 'min:3', 'max:100'],
                'location' => ['required', 'string', 'min:3', 'max:100'],
            ]);
        } catch (Error $err) { return [false, 'Fill all fields']; }

        $door = new Door();
        $door->name = $req->name;
        $door->description = $req->description;
        $door->location = $req->location;
        $door->save();
    }

    public function update(Request $req)
    {
        try {
            $req->validate([
                'name' => ['required', 'string', 'min:3', 'max:100'],
                'description' => ['required', 'string', 'min:3', 'max:100'],
                'location' => ['required', 'string', 'min:3', 'max:100'],
            ]);
        } catch (Error $err) { return [false, 'Fill all fields']; }

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

    public function getall(){ return Door::all();}
}
