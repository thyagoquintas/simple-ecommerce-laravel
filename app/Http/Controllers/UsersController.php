<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateProfileRequest;

class UsersController extends Controller
{
    public function index(){
        return view('users.index')->with('users', User::all());
    }

    public function changeAdmin(User $user){
        if($user->isAdmin())
            $user->role = 'user';
        else
            $user->role = 'admin';
        
        $user->save();
        session()->flash('success', 'Usuário alterado com sucesso!');
        return redirect()->back();
    }

    public function edit(){
        return view('users.edit')->with('user', auth()->user());
    }


    public function update(UpdateProfileRequest $request){
        $user = auth()->user();
        $user->name = $request->name;
        
        if($user->email != $request->email){
            $user->email = $request->email;
            $user->email_verified_at = null;
        }
        if($request->password)
            $user->password = Hash::make($request->password);
        
        $user->save();
        session()->flash('success', 'Usuário alterado com sucesso!');
        return redirect(route('users.edit-profile'));
    }
}
