@extends('users.layout')

@section('content')
    <div class="max-w-lg mx-auto">
        <div class="flex justify-between items-center mb-8 mt-12">
            <h2 class="text-3xl font-semibold text-left text-black">Show User</h2>
            <a class="bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 text-white" href="{{ route('users.index') }}"> Back</a>
        </div>
    </div>

    <div class="max-w-lg mx-auto">
        <div class="relative z-0 w-full mb-5 group">
            <div class="form-group">
                <strong>ID:</strong>
                {{ $user->id }}
            </div>
        </div>
        <div class="relative z-0 w-full mb-5 group">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $user->name }}
            </div>
        </div>
        <div class="relative z-0 w-full mb-5 group">
            <div class="form-group">
                <strong>Email:</strong>
                {{ $user->email }}
            </div>
        </div>
        <div class="relative z-0 w-full mb-5 group">
            <div class="form-group">
                <strong>CPF:</strong>
                {{ $user->cpf }}
            </div>
        </div>
        <div class="relative z-0 w-full mb-5 group">
            <div class="form-group">
                <strong>Birth Date:</strong>
                {{ $user->birth_date }}
            </div>
        </div>
        <div class="relative z-0 w-full mb-5 group">
            <div class="form-group">
                <strong>Street:</strong>
                {{ $user->street }}
            </div>
        </div>
        <div class="relative z-0 w-full mb-5 group">
            <div class="form-group">
                <strong>Street Number:</strong>
                {{ $user->street_number }}
            </div>
        </div>
        <div class="relative z-0 w-full mb-5 group">
            <div class="form-group">
                <strong>CEP:</strong>
                {{ $user->cep }}
            </div>
        </div>
        <div class="relative z-0 w-full mb-5 group">
            <div class="form-group">
                <strong>City:</strong>
                {{ $user->city }}
            </div>
        </div>
        <div class="relative z-0 w-full mb-5 group">
            <div class="form-group">
                <strong>UF:</strong>
                {{ $user->uf }}
            </div>
        </div>
        <div class="relative z-0 w-full mb-5 group">
            <div class="form-group">
                <strong>Active:</strong>
                {{ $user->active ? 'Yes' : 'No' }}
            </div>
        </div>
    </div>
@endsection
