@extends('layouts.app')
@section('content')



    <div class="container-fluid catalog mt-4">
        <div class="row">
            <div class="col-12 col-lg-3">
                <left-menu :section='@json($section ?? '')'></left-menu>
            </div>
            <div class="col-12 col-lg-9">
                <div class="card">
                    <div class="card-header h1">{{$section ?? ''->name??'Каталог продукции'}}</div>
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
        </div>

    </div>
    @if(method_exists($products,'links'))
        {{ $products->links() }}
    @endif
@endsection
