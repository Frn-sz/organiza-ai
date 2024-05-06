<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Throwable;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $users = User::all();

            return response()->json($users, 200);
        } catch (QueryException $e) {
            return response()->json(["error" => $e->getMessage()], 500);
        }
    }


    public function store(Request $request): JsonResponse
    {
        $this->validate($request, ["name" => "required", "email" => "required", "password" => "required"]);

        try {
            $User = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ]);

            return response()->json($User, 201);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Erro ao criar usuário!', 'error' => $e->getMessage()], 500);
        }
    }

    public function show(string $id): JsonResponse
    {
        try {
            $User = User::findOrFail($id);

            return response()->json($User, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Usuário não encontrado.', 'error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $this->validate($request, ['name' => 'required', 'email' => 'required', 'password' => 'required']);

        try {
            $User = User::findOrFail($id);

            $User->name = $request->name;
            $User->email = $request->email;
            $User->password = $request->password;

            $User->update();

            return response()->json($User, 201);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Erro ao editar usuário!', 'error' => $e->getMessage()], 500);
        }
    }

    public function destroy(string $id): JsonResponse
    {
        try {
            User::destroy($id);

            return response()->json(['message' => 'Usuário excluido com sucesso'], 200);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Erro ao excluir usuário'], 500);
        }
    }



    public function login(Request $request): JsonResponse
    {

        $credentials = $this->validate($request, ['email' => 'required', 'password' => 'required']);

        if (!auth()->attempt($credentials))
            return response()->json(['message' => 'Credenciais inválidas'], 401);


        /** @var \App\Models\User $User **/
        $User = auth()->user();
        $token = $User->createToken('auth-token')->plainTextToken;

        return response()->json(['token' => $token], 200);
    }
}
