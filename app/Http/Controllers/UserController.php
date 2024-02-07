<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

   public function index()
{
    $users = $this->userRepository->all();

    return response()->json($users);
}


    public function store(Request $request)
{
    dd($request);

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
        'state' => 'required|string',
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
        'state' => $request->input('state'),
        'uf' => $request->input('uf'),
        'active' => $request->input('active'),
    ]);

    return response()->json($user, 201);
}


    public function show(User $user)
    {
        return response()->json($user);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'string|max:255',
            'email' => 'email|unique:users|max:255',
            'password' => 'string|min:8',
            // Include other validation rules for additional fields
        ]);

        $user = $this->userRepository->update($user->id, [
            'name' => $request->input('name', $user->name),
            'email' => $request->input('email', $user->email),
            'password' => $request->input('password')
                ? Hash::make($request->input('password'))
                : $user->password,
            // Include other fields
        ]);

        return response()->json($user);
    }

    public function destroy(User $user)
    {
        $this->userRepository->delete($user->id);

        return response()->json(null, 204);
    }
}
