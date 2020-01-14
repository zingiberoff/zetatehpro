@extends('layouts.default')

@section('content')

    <main>

        <div class="home">
            <h1>Проектные решения</h1>
            <div class="links">
                <a href="{{route('catalog')}}" class="btn inverse"><img src="storage/cart.svg" alt="">Каталог</a>
                <a href="{{route('projects')}}"
                   class="btn inverse"><img src="storage/money.svg" alt="">
                    Бонусная <br> программа
                </a>
                <br>
                <a href="/price.xlsx" class="btn"><img src="storage/price.svg" alt="">Прайс</a>
                <a href="" class="btn"><img src="storage/medal.svg" alt="">О бренде</a>
                <a class="btn"><img src="storage/bank.svg" alt="">Контакты</a>
                <a class="btn"><img src="storage/convert.svg" alt="">Документация</a>
                <a class="btn"><img src="storage/download.svg" alt="">Скачать каталог</a>
            </div>
            <div class="dekor1"><img src="storage/main_logo.png" alt=""></div>
            <div class="dekor2"></div>
        </div>

    </main>

@endsection
