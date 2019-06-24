<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserUpdateProfilRequest;
use Hash;
use App\User;
use Auth;

class UserController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
	}

    public function index()
    {
    	return view('user.index');
    }

    public function update(UserUpdateProfilRequest $request)
    {
    	//Validations go through UserUpdateProfilRequest class
    	$user = User::whereId($request->edit_user_id)->first();

        $this->authorize('update', $user);

        //Check if current password is correct
    	if(! Hash::check($request->current_password, $user->password))
    		return response()->json(['incorrect_password' => true] , 422);
    	
    	if($request->new_password)
			$request['password'] = bcrypt($request['new_password']);
		
		$user->update($request->all());
		return response()->json(['user' => $user]);
    }	
}
