<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
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
            'email' => 'required|min:3|max:100|unique:users,email',
            'image' => 'file',
        ]);
        $path = null;
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

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'new_password' => 'required|min:8|max:100',
            'new_password_confirmation' => 'required|same:new_password',
        ]);
        if (Hash::check($request->old_password, $request->user()->password)) {
            $user = $request->user();
            $user->password = Hash::make($request->new_password);
            $user->save();
            return redirect('/');
        } else {
            $validator->errors()->add('old_password', 'old password is incorrect!');
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }
}
