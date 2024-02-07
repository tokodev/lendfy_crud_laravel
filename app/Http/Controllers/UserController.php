<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

   public function index(): View
    {
        $users = $this->userRepository->latestPaginated(5);

        return view('users.index', compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('users.create');
    }


    public function store(Request $request): RedirectResponse
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
        'active' => $request->filled('active') ? $request->input('active') : false,
    ]);

      return redirect()->route('users.index')
                        ->with('success','User created successfully.');
}

public function edit(User $user): View
    {
        return view('users.edit',compact('user'));
    }


    public function show(User $user): View
    {
        return view('users.show',compact('user'));
    }

    public function update(Request $request, User $user)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:8',
        'cpf' => 'required|string|unique:users,cpf,' . $user->id,
        'birth_date' => 'required|date',
        'street' => 'required|string',
        'street_number' => 'required|string',
        'cep' => 'required|string',
        'city' => 'required|string',
        'uf' => 'required|string|max:2',
    ]);

    $user = $this->userRepository->update($user, [
        'name' => $request->input('name'),
        'email' => $request->input('email'),
        'password' => $request->has('password') ? Hash::make($request->input('password')) : $user->password,
        'cpf' => $request->input('cpf'),
        'birth_date' => $request->input('birth_date'),
        'street' => $request->input('street'),
        'street_number' => $request->input('street_number'),
        'cep' => $request->input('cep'),
        'city' => $request->input('city'),
        'uf' => $request->input('uf'),
        'active' => $request->filled('active') ? $request->input('active') : false,
    ]);

    return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }


    public function destroy(User $user)
    {
        $this->userRepository->delete($user);

        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }
}
