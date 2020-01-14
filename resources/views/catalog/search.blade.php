@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                {{--Products <small>({{ $products->count() }})</small>--}}
            </div>
            <div class="card-body">
                <form action="{{ url('search') }}" method="get">
                    <div class="form-group">
                        <input
                                type="text"
                                name="q"
                                class="form-control"
                                placeholder="Search..."
                                value="{{ request('q') }}"
                        />
                    </div>
                </form>


                @forelse  ($products as $product)
                    <article class="mb-3">
                        <h2>{{ $product->name }}</h2>
                        <h3>{{$product->article}}</h3>
                        <p class="m-0">{{ $product->description }}</p>
                        <div>
                            @foreach ($product->properties as $property)
                                <b>{{$property->name}} </b>:
                                {{$property->value }}<br>
                            @endforeach
                        </div>
                    </article>
                @empty
                    <p>Ничего не найдено</p>
                @endforelse
            </div>
        </div>
    </div>
@stop