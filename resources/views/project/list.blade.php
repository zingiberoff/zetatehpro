@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Dashboard</div>


                    <div class="card-body">
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <td>Название</td>
                                <td>Создан</td>
                                <td>Подтвержден</td>
                                <td>Дата реализации</td>
                                <td>Реализован</td>
                                <td></td>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($projects as $project)
                                <tr>
                                    <td> {{$project->name}}</td>
                                    <td> {{$project->created_at}}</td>
                                    <td> {{$project->confirm}}</td>
                                    <td> {{$project->date_release}}</td>
                                    <td> {{$project->realise}}</td>

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

