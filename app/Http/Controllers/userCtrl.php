<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class userCtrl extends Controller
{
    public function authenticate(Request $req){
        try{
        $req->validate([
            'email'=>['required', 'string',  'min:3', 'max:100'],
            'password'=> ['required', 'string',  'min:6', 'max:100']
        ]);
        }catch(Error $err){return [false,'Fill all fields']; }

        $user = User::firstwhere('email', $req->email);

        if($user == null or !(Hash::check($req->password, $user->password))){
            return [false, 'Incorrect username or password'];
        }else{
            return true;
        }
    }

    public function add(Request $req){
        try{
            $req->validate([
                'name'=>['required', 'string',  'min:3', 'max:100'],
                'email'=>['required', 'string',  'min:3', 'max:100'],
                'password'=> ['required', 'string',  'min:6', 'max:100']
            ]);
        }catch(Error $err){return [false,'Fill all fields']; }
    
        $user = new User();
        $user->name = $req->name;
        $user->email=$req->email;
        $user->password=Hash::make($req->password);
        $user->save();
    }
}
