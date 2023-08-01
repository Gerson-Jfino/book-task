<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
            'role_id' => 'required|integer',
            'password' => 'required|string'
        ]);
        
    }
}
