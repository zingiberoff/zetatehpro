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
            <div class="tab-pane fade" id="nav-products" role="tabpanel" aria-labelledby="nav-products-tab">
                <table class="table">
                    <thead>
                    <tr>
                        <td rowspan="2">Артикул</td>
                        <td rowspan="2">Наименование</td>
                        <td rowspan="2">Количество</td>
                        <td colspan="3">Баллы</td>
                    </tr>
                    <tr>
                        <td>за включение в проект</td>
                        <td>за реализацию в проекте</td>
                        <td>Итого</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>

                            <td>{{$product['article']}}</td>
                            <td>{{$product['name']}}</td>
                            <td>{{$product['pivot']['count']}}</td>
                            <td>{{$product['cost_include']}}</td>
                            <td>{{$product['cost_realise']}}</td>
                            <td>{{$product['sum']}}</td>

                        </tr>
                    @endforeach

                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="3">Итого</td>
                        <td>{{$sumInclude ?? ''}}</td>
                        <td>{{$sumRealize}}</td>
                        <td>{{$sumAll}}</td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>

@endsection
