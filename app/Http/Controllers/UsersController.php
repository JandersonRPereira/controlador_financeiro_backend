<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isNull;

class UsersController extends Controller
{
    public function teste(){
        return "UsersController";
    }
    
    public function login(Request $request){
        $validate = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:8',
        ]);

        $email = (string)$request->email;
        $ret_user = DB::table('users')->where('email', $email)->first();
        if(!$ret_user)
            return response()->json(['status'=>0, 'message' => 'E-mail ou senha inválido!'], 200);
            
        if (password_verify($request->password, $ret_user->password)) {
            return response()->json(['status'=>1, 'message' => 'Loggeded', 'data'=>$ret_user], 200);
        } else {
            return response()->json(['status'=>0, 'message' => 'E-mail ou senha inválido!'], 200);
        }
    }
    

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = Users::get();
        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $users = new Users();
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = Hash::make($request->password);
        $res=$users->save($validate);
        $email = (string)$request->email;
        $ret_user = DB::table('users')->where('email', $email)->first();
        
            return response()->json(['status'=>1, 'message' => 'Created', 'data'=>$ret_user], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = Users::find($id);
        return response()->json(['status'=>true, 'data'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
        ]);

        $user = Users::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $res=$user->save($validate);

        return response()->json(['status'=>true, 'data'=>$user]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Users::destroy($id);
        return response()->json(['status'=>true, 'message' => 'Deleted']);
    }
}
