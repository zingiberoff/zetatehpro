@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Создать проект</div>

                    <form action="{{route('projects.store')}}"
                          method="post"
                          class="p-4"
                          enctype="multipart/form-data">
                        @csrf
                        @include('project.form.edit')

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection