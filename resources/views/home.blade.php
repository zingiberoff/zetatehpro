@extends('layouts.default')

@section('content')
    <header>

    </header>
    <main>
        <div class="home">
            <h1>Проектные решения</h1>
            <div class="links">
                <a class="btn inverse">Каталог</a>
                <a href="{{route('projects')}}"
                   class="btn inverse">
                    Бонусная <br> программа
                </a>
                <br>
                <a href="/price.xlsx" class="btn">Прайс</a>
                <a href="" class="btn">О бренде</a>
                <a class="btn">Контакты</a>
                <a class="btn">Техническая документация</a>
                <a class="btn">Скачать каталог</a>
            </div>
            <div class="dekor1"></div>
            <div class="dekor2"></div>
        </div>

    </main>

@endsection
