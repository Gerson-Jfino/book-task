<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    private $user;
    public function __construct(User $user) {
        $this->user = $user;
    }
    public function index() {
        $users = $this->user->get();
        return response()->json($users, 200);
    }
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
        $input = $request->only(['name', 'email']);
        $input['password'] = Hash::make($request->password);
        $input['active'] = true;
        $input['first_login'] = true;
        $input['login_attempts'] = 0;
        $input['role_id'] = 0;
        DB::beginTransaction();
        try {
            $this->user->create($input);
            DB::commit();
            return response()->json(["message" => "utilizador criado com sucesos"], 201);
        } catch (\Exception $e) {
            return response()->json($e, 500);
        }
        
    }
}
