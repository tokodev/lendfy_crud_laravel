<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{

     protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = $this->userRepository->all();

        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users|max:255',
        'password' => 'required|string|min:8',
        'cpf' => 'required|string|unique:users',
        'birth_date' => 'required|date',
        'street' => 'required|string',
        'street_number' => 'required|string',
        'cep' => 'required|string',
        'city' => 'required|string',
        'uf' => 'required|string|max:2',
        'active' => 'required|boolean',
    ]);

    $user = $this->userRepository->create([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => Hash::make($request->input('password')),
        'cpf' => $request->input('cpf'),
        'birth_date' => $request->input('birth_date'),
        'street' => $request->input('street'),
        'street_number' => $request->input('street_number'),
        'cep' => $request->input('cep'),
        'city' => $request->input('city'),
        'uf' => $request->input('uf'),
        'active' => $request->input('active'),
    ]);


    return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        $user = $this->userRepository->find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(UserRequest $request, string $id)
    {
        $user = $this->userRepository->find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'required|string|min:8',
            'cpf' => 'required|string|unique:users,cpf,' . $id,
            'birth_date' => 'required|date',
            'street' => 'required|string',
            'street_number' => 'required|string',
            'cep' => 'required|string',
            'city' => 'required|string',
            'uf' => 'required|string|max:2',
            'active' => 'required|boolean',
        ]);

        $attributes = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'cpf' => $request->input('cpf'),
            'birth_date' => $request->input('birth_date'),
            'street' => $request->input('street'),
            'street_number' => $request->input('street_number'),
            'cep' => $request->input('cep'),
            'city' => $request->input('city'),
            'uf' => $request->input('uf'),
            'active' => $request->input('active'),
        ];

        $success = $this->userRepository->update($user, $attributes);

        if ($success) {
            // Recarrega o usuário após a atualização para obter os dados atualizados
            $user = $this->userRepository->find($id);

            return response()->json($user);
        } else {
            return response()->json(['error' => 'User update failed'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): JsonResponse
    {
        $user = $this->userRepository->find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }


        $success = $this->userRepository->delete($user);

        if ($success) {
           return response()->json(['message' => 'User deleted successfully']);
        } else {
            return response()->json(['error' => 'User deleted failed'], 500);
        }
    }
}
