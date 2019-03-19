<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Compound;

class ProfilesController extends Controller
{
    public function show()
    {
        return view('profiles.show', [
            'user' => auth()->user()
        ]);
    }

}
