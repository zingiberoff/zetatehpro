<div class="row align-items-stretch">

    @foreach ($products as $product)

        <div class="col-3 mb-4">
            <div class="item-card">

                <div class="card">
                    <div class="image"><img src="{{$product->picture()}}" alt=""></div>
                    <div class="title h5">{{ $product->name }}</div>
                    <div class="title h6">{{ $product->article }}</div>
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
                     <div class="alert alert-dark" role="alert">
                      <h6>Награда за включение:  {{ $product->cost_include}}</h6>
                      <h6>Награда за реализацию: {{ $product->cost_realise}}</h6>
                     </div>
                     
                   
                    @endrole
                    <div class="props">
                        @foreach ($product->properties as $property)
                            @if($property->value == 'true' || $property->value == 'false' || $property->name == 'Размер шестигранника (наруж. диаметр гайки)' || $property->name == 'Цвет' || 
                                $property->name == 'Размер гаечного ключа' || $property->name == 'Номин. размер резьбы метрической M/PG' || $property->name == 'Номин. размер резьбы в дюймах NPT/резьбы газовой трубы' || $property->name == 'Шаг резьбы')  
                            @else                
                              <b>{{$property->name}} </b>:
                              {{$property->value }}<br>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="overlay"></div>
            </div>
        </div>
    @endforeach
</div>