@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Подтвержденные пользователи</div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>Логин</td>
                                <td>e-mail</td>
                                <td>Телефон</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td> {{$user->name}}</td>
                                <td> {{$user->email}}</td>
                                <td> {{$user->phone}}</td>
                            </tr>
                            @endforeach
                            <tr></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@if (session('status'))
<div class="alert alert-success" role="alert">
    {{ session('status') }}
</div>
@endif
@endsection