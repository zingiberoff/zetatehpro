@extends('layouts.app')
@section('content')
    <div class="container">
        @foreach ($products as $product)
            <h1>{{ $product->name }}</h1>

            @foreach ($product->properties as $property)
                <b>{{$property->name}} </b>:
                {{$property->value }}<br>
            @endforeach
            <br>
        @endforeach
    </div>

    {{ $products->links() }}
@endsection