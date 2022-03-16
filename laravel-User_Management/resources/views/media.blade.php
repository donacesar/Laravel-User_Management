@extends('layout')

@section('title')
    {{ 'Аватар' }}
@endsection

@section('header-title')
    {{'Загрузить Аватар'}}
@endsection

@section('content')
    <main id="js-page-content" role="main" class="page-content mt-3">
        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-image'></i> Загрузить аватар {{$id}}
            </h1>

        </div>
        <form action="admin/media/{{$id}}" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-xl-6">
                    <div id="panel-1" class="panel">
                        <div class="panel-container">
                            <div class="panel-hdr">
                                <h2>Текущий аватар</h2>
                            </div>
                            <div class="panel-content">
                                <div class="form-group">
                                    <img src="img/demo/authors/josh.png" alt=""   class="img-responsive" width="200">
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="avatar_input">Выберите аватар</label>
                                    <input type="file" id="avatar_input" name="image" class="form-control-file">
                                </div>

                                {{csrf_field()}}

                                <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                    <button class="btn btn-warning">Загрузить</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>
@endsection
