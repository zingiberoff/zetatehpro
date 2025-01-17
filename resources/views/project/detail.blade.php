@extends('layouts.app')
@section('content')
    <div class="container">
        @canAndOwns('update-project', $project)
        <project-detail project_id="{{$project->id}}"></project-detail>
        @endOwns

        @role('moderator')
        <project-detail project_id="{{$project->id}}"></project-detail>
        @endrole

    </div>

@endsection
