@extends('layouts.app')
@section('content')



    <div class="container catalog mt-4">
      <left-menu></left-menu>
        <div class="card">
            <div class="card-header h1">{{$title??'Каталог продукции'}}</div>
            <div class="p-4">
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


                @include('catalog.list')


            </div>
        </div>

    </div>

    {{ $products->links() }}
@endsection
