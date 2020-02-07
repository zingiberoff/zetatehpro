@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">

                <div class="card">
                    <div class="card-header">Проекты</div>


                    <div class="card-body">
                        <a href="{{route('projects.create')}}" class="btn btn-info">Создать </a>
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <td>Название</td>
                                <td>Создан</td>
                                <td>Подтвержден</td>
                                <td>Дата реализации</td>
                                <td>Реализован</td>
                                <td>Баллы</td>
                                @if($moderate ?? '')
                                    <td>Пользователь</td>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($projects as $project)
                                <tr>
                                    <td><a href="{{route('projects.show',[$project->id])}}">{{$project->name}}</a></td>
                                    <td> {{$project->created_at}}</td>
                                    <td> {{$project->confirm}}</td>
                                    <td> {{$project->date_release}}</td>
                                    <td> {{$project->realise}}</td>

                                    <td> {{$project->sumAll}}</td>
                                    @if($moderate ?? '')
                                        <td>{{$project->user->name}}</td>
                                    @endif
                                </tr>

                            @endforeach
                            <tr>
                                {{$totalScore ?? ''}}
                            </tr>
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

