@extends('users.layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New User</h2>
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

    <form action="{{ route('users.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" class="form-control" placeholder="Email">
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
                    <input type="text" name="cpf" class="form-control" placeholder="CPF">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="birth_date">Birth Date:</label>
                    <input type="date" name="birth_date" class="form-control">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="street">Street:</label>
                    <input type="text" name="street" class="form-control" placeholder="Street">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="street_number">Street Number:</label>
                    <input type="text" name="street_number" class="form-control" placeholder="Street Number">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="cep">CEP:</label>
                    <input type="text" name="cep" class="form-control" placeholder="CEP">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="city">City:</label>
                    <input type="text" name="city" class="form-control" placeholder="City">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="uf">UF:</label>
                    <input type="text" name="uf" class="form-control" placeholder="UF">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="active">Status:</label>
                    <input type="checkbox" name="active" class="form-check-input" value="1">
                </div>
            </div>
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection
