<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');        
    }
    public function show(Request $request)
    {
        return  view('account.show', ['user' => $request->user()]);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:100',
            'email' => 'required|min:3|max:100',
            'image' => 'file',
        ]);

        if ($request->hasFile('image'))
        {
            $path = $request->image->store('images');
        }
        $request->user()->update([
            'name' => $request->name,
            'email' => $request->email,
            'avatar' => $path,
        ]);
        return redirect('/');
    }

    
}
