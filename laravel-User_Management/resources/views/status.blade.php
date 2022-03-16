@extends('layout')

@section('title')
    {{'Статус'}}
@endsection

@section('header-title')
    {{'Статус'}}
@endsection

@section('content')
    <main id="js-page-content" role="main" class="page-content mt-3">
        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-sun'></i> Установить статус {{$id}}
            </h1>

        </div>
        <form action="admin/status/{{$id}}" method="post">
            <div class="row">
                <div class="col-xl-6">
                    <div id="panel-1" class="panel">
                        <div class="panel-container">
                            <div class="panel-hdr">
                                <h2>Установка текущего статуса</h2>
                            </div>
                            <div class="panel-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <!-- status -->
                                        <div class="form-group">
                                            <label class="form-label" for="status_select">Выберите статус</label>
                                            <select class="form-control" name="status" id="status_select">
                                                <option value="online">Онлайн</option>
                                                <option value="away">Отошел</option>
                                                <option value="busy">Не беспокоить</option>
                                            </select>
                                        </div>
                                    </div>
                                    {{csrf_field()}}
                                    <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                        <button class="btn btn-warning">Установить Статус</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    </main>
@endsection
