<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UserCreationRequest;
use App\Http\Requests\UserUpdateRequest;

class AdminUsersController extends Controller
{

    public function index()
    {
        return view('admin.customers.index', [
            'customers' => User::getAllCustomers()
        ]);
    }


    public function store(UserCreationRequest $request)
    {
        //Validation takes place via UserCreationRequest class.
  
        $request['password'] = bcrypt($request['password']);
        $user = User::create($request->all());

        return response()->json(['user' => $user]);
    }


    public function update(UserUpdateRequest $request, $id)
    {
        //Validation takes place via UserUpdateRequest class.

        $user = User::findOrFail($id);
        $user->update($request->all());
        return response()->json(['user' => $user]);
    }

 
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return response()->json([]); 
        //Empty response with 200 status, no need for data to pass since it is just a delete action.
    }
}
