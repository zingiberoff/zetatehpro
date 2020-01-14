<div class="row align-items-stretch">

    @foreach ($products as $product)

        <div class="col-3 mb-4">
            <div class="item-card">

                <div class="card">
                    <div class="image"><img src="{{$product->image}}" alt=""></div>
                    <div class="title h5">{{ $product->name }}</div>
                    @role('moderator')
                    <form action="{{route('changeProductCost',['product'=>$product->id])}}"
                          method="post">
                        @csrf
                        <div class="form-group row">

                            <div class="col-sm-12">
                                <input type="text"
                                       required
                                       class="form-control"
                                       name="cost_include"
                                       aria-describedby="nameHelp"
                                       placeholder="Награда за включение"
                                       value="{{ $product->cost_include}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <input type="text"
                                       required
                                       class="form-control"
                                       id="inputName"
                                       name="cost_realise"
                                       aria-describedby="nameHelp"
                                       placeholder="Награда за реализацию"
                                       value="{{ $product->cost_realise}}">
                            </div>

                        </div>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </form>
                    @endrole
                    @role('user')
                    <b>Награда за включение: </b>{{ $product->cost_include}}
                    <b>Награда за реализацию: </b>{{ $product->cost_realise}}
                    @endrole
                    <div class="props">
                        @foreach ($product->properties as $property)
                            <b>{{$property->name}} </b>:
                            {{$property->value }}<br>
                        @endforeach
                    </div>
                </div>
                <div class="overlay"></div>
            </div>
        </div>
    @endforeach
</div>