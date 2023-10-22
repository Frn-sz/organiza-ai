<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
    }

    public function store(Request $request)
    {
        $this->validate($request, ["name" => "required", "email" => "required", "password" => "required"]);

        try {
            $User = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]);

            return response()->json($User, 200);
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->json(['message' => 'Erro ao criar usuário!', 'error' => $e->getMessage()], 500);
        }
    }
}
