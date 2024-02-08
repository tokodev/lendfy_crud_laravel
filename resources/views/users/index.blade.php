@extends('users.layout')

@section('content')
    <!-- Page header -->
    <div class="flex justify-between items-center mb-8 mt-12">
        <h2 class="text-3xl font-semibold text-left text-black">
            Laravel 10 User CRUD Application - Lendfy
        </h2>
        <a href="{{ route('users.create') }}" class="bg-green-700 hover:bg-green-800 focus:outline-none focus:ring-4 focus:ring-green-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 text-white">
            Create New User
        </a>
    </div>

    <!-- Success message -->
    @if ($message = Session::get('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 mt-8 mb-8" role="alert">
            <p>{{ $message }}</p>
        </div>
    @endif

    <!-- Users table -->
    <div class="overflow-x-auto shadow-md rounded-lg mb-8">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="bg-blue-200 dark:bg-blue-700 text-xs text-white uppercase">
                <tr>
                    <th class="px-6 py-3">No</th>
                    <th class="px-6 py-3">Name</th>
                    <th class="px-6 py-3">CPF</th>
                    <th class="px-6 py-3">Age</th>
                    <th class="px-6 py-3">Birth Date</th>
                    <th class="px-6 py-3" width="320px">Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop through users -->
                @foreach ($users as $user)
                    <tr class="{{ $loop->odd ? 'bg-green-50 dark:bg-gray-800' : 'bg-yellow-50 dark:bg-gray-700' }}">
                        <td class="px-6 py-3">{{ ++$i }}</td>
                        <td class="px-6 py-3">{{ $user->name }}</td>
                        <td class="px-6 py-3">{{ $user->cpf }}</td>
                        <td class="px-6 py-3">{{ calculateAge($user->birth_date) }} years old</td>
                        <td class="px-6 py-3">{{ $user->birth_date }}</td>
                        <td class="px-6 py-3">
                            <!-- User actions form -->
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure you want to delete this user?');">
                                <a href="{{ route('users.show', $user->id) }}" class="text-white bg-blue-700 hover:bg-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Show</a>
                                <a href="{{ route('users.edit', $user->id) }}" class="text-white bg-yellow-400 hover:bg-yellow-500 focus:outline-none focus:ring-4 focus:ring-yellow-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:focus:ring-yellow-900">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    {!! $users->links() !!}

@endsection

@php
    // Function to calculate age from birth date
    function calculateAge($birthDate) {
        $birthDate = new DateTime($birthDate);
        $today = new DateTime();
        $age = $today->diff($birthDate);
        return $age->y;
    }
@endphp
