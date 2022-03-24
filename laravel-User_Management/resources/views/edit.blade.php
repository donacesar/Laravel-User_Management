@extends('layout')

@section('title')
    {{'Изменить'}}
@endsection

@section('header-title')
    {{'Редактировать'}}
@endsection

@section('content')
    @php
        \App\Http\Controllers\PageController::access($id);
    @endphp
    <main id="js-page-content" role="main" class="page-content mt-3">
        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-plus-circle'></i> Редактировать {{$id}}
            </h1>

        </div>
        <form action="admin/edit/{{$id}}" method="post">
            <div class="row">
                <div class="col-xl-6">
                    <div id="panel-1" class="panel">
                        <div class="panel-container">
                            <div class="panel-hdr">
                                <h2>Общая информация</h2>
                            </div>
                            <div class="panel-content">
                                <!-- username -->
                                <div class="form-group">
                                    <label class="form-label" for="name_input">Имя</label>
                                    <input type="text" id="name_input" name="name" class="form-control" value="">
                                </div>

                                <!-- title -->
                                <div class="form-group">
                                    <label class="form-label" for="workplace_input">Место работы</label>
                                    <input type="text" id="workplace_input" name="workplace" class="form-control" value="">
                                </div>

                                <!-- tel -->
                                <div class="form-group">
                                    <label class="form-label" for="phone_input">Номер телефона</label>
                                    <input type="text" id="phone_input" name="phone" class="form-control" value="">
                                </div>

                                <!-- address -->
                                <div class="form-group">
                                    <label class="form-label" for="address_input">Адрес</label>
                                    <input type="text" id="address_input" name="address" class="form-control" value="">
                                </div>
                                {{csrf_field()}}
                                <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                    <button class="btn btn-warning">Редактировать</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>
@endsection
