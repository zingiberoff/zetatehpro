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