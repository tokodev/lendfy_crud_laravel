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
    /**
     * The User repository instance.
     *
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * The states array.
     *
     * @var array
     */
    public $states;

    /**
     * UserController constructor.
     *
     * @param UserRepository $userRepository
     */

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->states = [
            'AC' => 'Acre',
            'AL' => 'Alagoas',
            'AP' => 'Amapá',
            'AM' => 'Amazonas',
            'BA' => 'Bahia',
            'CE' => 'Ceará',
            'DF' => 'Distrito Federal',
            'ES' => 'Espírito Santo',
            'GO' => 'Goiás',
            'MA' => 'Maranhão',
            'MT' => 'Mato Grosso',
            'MS' => 'Mato Grosso do Sul',
            'MG' => 'Minas Gerais',
            'PA' => 'Pará',
            'PB' => 'Paraíba',
            'PR' => 'Paraná',
            'PE' => 'Pernambuco',
            'PI' => 'Piauí',
            'RJ' => 'Rio de Janeiro',
            'RN' => 'Rio Grande do Norte',
            'RS' => 'Rio Grande do Sul',
            'RO' => 'Rondônia',
            'RR' => 'Roraima',
            'SC' => 'Santa Catarina',
            'SP' => 'São Paulo',
            'SE' => 'Sergipe',
            'TO' => 'Tocantins',
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
   public function index(): View
    {
        $users = $this->userRepository->latestPaginated(5);

        return view('users.index', compact('users'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $states = $this->states;
        return view('users.create', compact('states'));
    }


     /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // Validation rules
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

        // Create a new user
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

        // Redirect to the index page with success message
      return redirect()->route('users.index')
                        ->with('success','User created successfully.');
}

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return View
     */
    public function edit(User $user): View
    {
       $states = $this->states;
       return view('users.edit',compact('user', 'states'));
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return View
     */
    public function show(User $user): View
    {
        return view('users.show',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return RedirectResponse
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user)
    {
        $this->userRepository->delete($user);

        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }
}
