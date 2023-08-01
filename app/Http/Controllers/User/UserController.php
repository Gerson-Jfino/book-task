<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    private $user;
    private $role;
    public function __construct(User $user, Role $role) {
        $this->user = $user;
        $this->role = $role;
    }
    public function index() {
        $users = $this->user->with('role')->get();
        return response()->json($users, 200);
    }
    public function show($id) {
        $users = $this->user->with('role')->find($id);
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
        $input['role_id'] = 2;
        DB::beginTransaction();
        try {
            $this->user->create($input);
            DB::commit();
            return response()->json(["message" => "utilizador criado com sucesos"], 201);
        } catch (\Exception $e) {
            return response()->json($e, 500);
        }
        
    }
    public function update(Request $request, $id) {
        $input = $request->only(['role_id']);
        DB::beginTransaction();
        try {
            $user = $this->user->find($id);
            if (empty($user)) {
                return response()->json(["message" => "Utilizador não encontrado"], 404);
            }
            $user->update($input);
            DB::commit();
            return response()->json(["message" => "permissões atualizadas"], 200);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json($e, 500);
        }
    }
    public function getRole() {
        $role = $this->role->get();
        return response()->json($role, 200);
    }
}
