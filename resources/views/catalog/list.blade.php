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
                        <br>
                        {{-- @if(($product->sections[0]->id >= 28 && $product->sections[0]->id <= 34) || ($product->sections[0]->id >= 55 && $product->sections[0]->id <= 70)) --}}
                        @if(($product->sections[0]->id >= 1 && $product->sections[0]->id <= 7) || ($product->sections[0]->id >= 26 && $product->sections[0]->id <= 41))
                            {{-- Кабельные вводы --}}
                            @foreach ($product->properties as $property)
                                @if($property->name == 'Номин. размер резьбы метрической M/PG' || $property->name == 'Номин. размер резьбы в дюймах NPT/резьбы газовой трубы' || $property->name == 'Для взрывоопасной зоны по газу (Ex)' || $property->name == 'Степень защиты (IP)' || $property->name == 'Подходит для кабеля диаметром:' || $property->name == 'Взрывобезопасное исполнение' || $property->name == 'Шаг резьбы' || $property->name == 'Материал' || $property->name == 'Тип резьбы' || $property->name == 'Рабочая температура' || $property->name == 'Вид/марка материала' || $property->name == 'Длина резьбы')  
                                    <b>{{$property->name}} </b>:
                                    {{$property->value }}<br>
                                @endif
                            @endforeach

                        {{-- @elseif ($product->sections[0]->id >= 9 && $product->sections[0]->id <= 25) --}}
                        @elseif ($product->sections[0]->id >= 9 && $product->sections[0]->id <= 25)
                            {{-- Гайки --}}
                            @foreach ($product->properties as $property)
                                @if($property->name == 'Шаг резьбы' || $property->name == 'Материал' || $property->name == 'Тип резьбы' || $property->name == 'Вид/марка материала' || $property->name == 'Размер гаечного ключа' || $property->name == 'Размер резьбы в дюймах' || $property->name == 'Метрический размер резьбы (М..)' || $property->name == 'Высота' || $property->name == 'С фланцем')  
                                    <b>{{$property->name}} </b>:
                                    {{$property->value }}<br>
                                @endif
                            @endforeach

                        {{-- @elseif ($product->sections[0]->id >= 9 && $product->sections[0]->id <= 25) --}}
                        @elseif ($product->sections[0]->id >= 42 && $product->sections[0]->id <= 54)
                            {{-- Металлорукав --}}
                            @foreach ($product->properties as $property)
                                @if($property->name == 'Степень защиты (IP)' || $property->name == 'Материал' || $property->name == 'Рабочая температура' || $property->name == 'Цвет' || $property->name == 'С протяжкой (зондом)' || $property->name == 'Прочность (сопротивление) при изгибе' || $property->name == 'Номин. диаметр' || $property->name == 'Прочность на разрыв' || $property->name == 'Уплотнение' || $property->name == 'Распространяет горение' || $property->name == 'Прочность при сжатии' || $property->name == 'Внутр. диаметр' || $property->name == 'Наруж. диаметр')  
                                    <b>{{$property->name}} </b>:
                                    {{$property->value }}<br>
                                @endif
                            @endforeach

                        {{-- @elseif ($product->sections[0]->id >= 9 && $product->sections[0]->id <= 25) --}}
                        @elseif ($product->sections[0]->id >= 8 && $product->sections[0]->id <= 8)
                            {{-- Коробки --}}
                            @foreach ($product->properties as $property)
                                @if($property->name == 'Для взрывоопасной зоны по пыли (Ex)' || $property->name == 'Для взрывоопасной зоны по газу (Ex)' || $property->name == 'Степень защиты (IP)' || $property->name == 'Взрывобезопасное исполнение' || $property->name == 'Материал' || $property->name == 'Рабочая температура' || $property->name == 'Защитное покрытие поверхности' || $property->name == 'Цвет' || $property->name == 'Макс. поперечное сечение проводника' || $property->name == 'Крепление крышки' || $property->name == 'Количество вводов' || $property->name == 'Рабочая температура' || $property->name == 'Тип ввода' || $property->name == 'Длина' || $property->name == 'Количество соединительных зажимов/клемм' || $property->name == 'С крышкой (-ами)' || $property->name == 'Глубина' || $property->name == 'Ширина' || $property->name == 'Способ монтажа')  
                                    <b>{{$property->name}} </b>:
                                    {{$property->value }}<br>
                                @endif
                            @endforeach
                        @else
                            @foreach ($product->properties as $property)
                                @if($property->value == 'true' || $property->value == 'false' || $property->name == 'Размер шестигранника (наруж. диаметр гайки)' || $property->name == 'Цвет' || 
                                    $property->name == 'Размер гаечного ключа' || $property->name == 'Номин. размер резьбы метрической M/PG' || $property->name == 'Номин. размер резьбы в дюймах NPT/резьбы газовой трубы' || $property->name == 'Шаг резьбы')  
                                @else                
                                    <b>{{$property->name}} </b>:
                                    {{$property->value }}<br>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="overlay"></div>
            </div>
        </div>
    @endforeach
</div>