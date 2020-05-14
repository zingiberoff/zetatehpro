@extends('layouts.app')
@section('content')
<div class="container-fluid catalog mt-4">
        <div class="row">
            <div class="col-12 col-lg-3">
                <left-menu :section='@json($section ?? '')'></left-menu>
            </div>
            <div class="col-12 col-lg-9">
                <div class="card">
                    <div class="card-header h1">Инструмент подбора муфт</div>
                    <selection></selection>
                </div>
            </div>
        </div>

    </div>
@endsection
