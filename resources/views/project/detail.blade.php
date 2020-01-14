@extends('layouts.app')
@section('content')
    <div class="container">

        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
                   aria-controls="nav-home" aria-selected="true">Проект</a>
                <a class="nav-item nav-link" id="nav-products-tab" data-toggle="tab" href="#nav-products" role="tab"
                   aria-controls="nav-products" aria-selected="false">Товары</a>

            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <h2>{{$name}}</h2>
                <h5>Описание проекта:</h5>
                {{$description}}
                <dl>
                    <dd>Дата реализации</dd>
                    <dt>{{$date_release}}</dt>
                </dl>
                <h5>Зказчик проекта:</h5>
                @dump($customer)
            </div>
            @include('project.patricles.products')
        </div>

    </div>

@endsection
