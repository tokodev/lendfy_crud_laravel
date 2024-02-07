@extends('users.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit User</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $user->name }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $user->email }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <small>The password field must be at least 8 characters.</small>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="cpf">CPF:</label>
                    <input type="text" name="cpf" class="form-control" placeholder="CPF" value="{{ $user->cpf }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="birth_date">Birth Date:</label>
                    <input type="date" name="birth_date" class="form-control" value="{{ $user->birth_date }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="street">Street:</label>
                    <input type="text" name="street" class="form-control" placeholder="Street" value="{{ $user->street }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="street_number">Street Number:</label>
                    <input type="text" name="street_number" class="form-control" placeholder="Street Number" value="{{ $user->street_number }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="cep">CEP:</label>
                    <input type="text" name="cep" class="form-control" placeholder="CEP" value="{{ $user->cep }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="city">City:</label>
                    <input type="text" name="city" class="form-control" placeholder="City" value="{{ $user->city }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="uf">UF:</label>
                    <input type="text" name="uf" class="form-control" placeholder="UF" value="{{ $user->uf }}">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="active">Status:</label>
                   <input type="checkbox" name="active" class="form-check-input" value="1" {{ $user->active ? 'checked' : '' }}>
                </div>
            </div>
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </div>
    </form>
@endsection
