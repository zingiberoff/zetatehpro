<div class="form-group row">
    <label for="inputName" class="col-sm-3 col-form-label">Название проекта</label>
    <div class="col-sm-9">
        <input type="text"
               required
               class="form-control"
               id="inputName"
               name="project[name]"
               aria-describedby="nameHelp"
               placeholder="Название проекта"
               value="{{ $project['name']}}">
    </div>

</div>
<div class="form-group row">
    <label for="exampleInputPassword1" class="col-sm-3 col-form-label">Описание проекта</label>
    <div class="col-sm-9">
            <textarea
                    class="form-control"
                    id="exampleInputPassword1"
                    name="project[description]"
                    rows="3"
                    aria-describedby="nameDescr"
                    placeholder="Описание проекта"
            >{{ $project['description']}}</textarea>
        <small id="nameDescr" class="form-text text-muted">Подробное описание проекта</small>
    </div>
</div>
<div class="form-group row">
    <label for="inputDateRealise" class="col-sm-3 col-form-label">Срок реализации</label>
    <div class="col-sm-9">
        <input type="text"
               class="form-control date-mask"
               id="inputDateRealise"
               name="project[date_release]"
               value="{{ $project['date_release']}}"

               placeholder="Планируемый срок реализации проекта">
    </div>
</div>

<hr>
<h4>Заказчик проекта</h4>
<div class="form-group row">
    <label for="exampleInputEmail1" class="col-sm-3 col-form-label">ИНН</label>
    <div class="col-sm-9">
        <input type="text"
               class="form-control"
               id="inputINN"
               name="customer[inn]"
               value="{{$customer['inn']}}"
               placeholder="ИНН заказчикпа проекта">
    </div>
</div>
<div class="form-group row">
    <label for="exampleInputEmail1" class="col-sm-3 col-form-label">Наименование</label>
    <div class="col-sm-9">
        <input type="text"
               class="form-control"
               id="inputINN"
               name="customer[name]"
               value="{{$customer['name']}}"
               placeholder="Заказчик проекта">
    </div>
</div>

<div class="form-group row">
    <label for="inputFIO"
           class="col-sm-3 col-form-label"
    >
        Контактное лицо
    </label>
    <div class="col-sm-9">
        <input type="text"
               class="form-control" id="inputFIO"
               name="customer[contact_person]"
               value="{{$customer['contact_person']}}"
               placeholder="ФИО контактного лица">
    </div>
</div>
<div class="form-group row">
    <label for="inputCity" class="col-sm-3 col-form-label">Город</label>
    <div class="col-sm-9">
        <input type="text" class="form-control"
               value="{{$customer['city']}}" id="inputCity" name="customer[city]"
               placeholder="Город заказчика">
    </div>
</div>
<div class="form-group">
    <label for="inputFiles">Загрузите Файлы проекта</label>
    <input type="file" multiple class="form-control-file" name="files[]" id="inputFiles">
</div>

<button type="submit" class="btn btn-primary">Сохранить</button>
