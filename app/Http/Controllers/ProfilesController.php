<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfilesController extends Controller
{
    public function show()
    {
        return view('profiles.show', [
            'user' => auth()->user()
        ]);
    }

    public function update()
    {
        $user = auth()->user();

        request()->validate([
            'name' => [Rule::unique('users')->ignore($user->id), 'required'],
            'email' => ['email' , Rule::unique('users')->ignore($user->id), 'required'],
            'password' => ['nullable','min:6', 'confirmed'],
        ]);

        if(Request()->get('password') == ''){
            $user->update(request()->except('password'));
        }
        else
        {
            $user->update([
                'name' => request('name'),
                'email' => request('email'),
                'password' => bcrypt(request('password'))
            ]);
        }

        return response('Profile Updated', 200);
    }

}
