<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Chartist.html">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <base href="http://laravel-user-management"></base>
    <link id="vendorsbundle" rel="stylesheet" media="screen, print" href="css/vendors.bundle.css">
    <link id="appbundle" rel="stylesheet" media="screen, print" href="css/app.bundle.css">
    <link id="myskin" rel="stylesheet" media="screen, print" href="css/skins/skin-master.css">
    <link rel="stylesheet" media="screen, print" href="css/fa-solid.css">
    <link rel="stylesheet" media="screen, print" href="css/fa-brands.css">
    <link rel="stylesheet" media="screen, print" href="css/fa-regular.css">
    <link rel="stylesheet" href="css/my-styles.css">
    <title>@yield('title')</title>

</head>

<body class="mod-bg-1 mod-nav-link">
<nav class="navbar navbar-expand-lg navbar-dark bg-primary bg-primary-gradient">
    <a class="navbar-brand d-flex align-items-center fw-500" href="#"><img alt="logo" class="d-inline-block align-top mr-2" src="img/logo.png">@yield('header-title')</a> <button aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-target="#navbarColor02" data-toggle="collapse" type="button"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navbarColor02">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="/">Главная <span class="sr-only">(current)</span></a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">

            @if(!(\Illuminate\Support\Facades\Auth::check()))
                <li class="nav-item">
                    <a class="nav-link" href="login">Войти</a>
                </li>
            @endif

                @if(\Illuminate\Support\Facades\Auth::check())
                    @php
                        $current_id = \Illuminate\Support\Facades\Auth::user()->id;
                        $member_id = \App\Member::one($current_id)->id;

                    @endphp
                    <li>
                        <strong><a class="nav-link" href="/profile/{{$member_id}}">{{\Illuminate\Support\Facades\Auth::user()->name}}</a></strong>
                    </li>
                @endif






            <li class="nav-item">
                <a class="nav-link" href="logout">Выйти</a>
            </li>
        </ul>
    </div>
</nav>



    @yield('content')


<!-- BEGIN Page Footer -->
<footer class="page-footer" role="contentinfo">
    <div class="d-flex align-items-center flex-1 text-muted">
        <span class="hidden-md-down fw-700">2022 © Менеджер Пользователей</span>
    </div>
    <div>
        <ul class="list-table m-0">
            <li><a href="/" class="text-secondary fw-700"><i class="fas fa-home"></i></a></li>
            <li class="pl-3"><a href="#" class="text-secondary fw-700"><i class="fas fa-address-card"></i></a></li>
        </ul>
    </div>
</footer>

</body>

<script src="js/vendors.bundle.js"></script>
<script src="js/app.bundle.js"></script>
<script>

    $(document).ready(function()
    {

        $('input[type=radio][name=contactview]').change(function()
        {
            if (this.value == 'grid')
            {
                $('#js-contacts .card').removeClassPrefix('mb-').addClass('mb-g');
                $('#js-contacts .col-xl-12').removeClassPrefix('col-xl-').addClass('col-xl-4');
                $('#js-contacts .js-expand-btn').addClass('d-none');
                $('#js-contacts .card-body + .card-body').addClass('show');

            }
            else if (this.value == 'table')
            {
                $('#js-contacts .card').removeClassPrefix('mb-').addClass('mb-1');
                $('#js-contacts .col-xl-4').removeClassPrefix('col-xl-').addClass('col-xl-12');
                $('#js-contacts .js-expand-btn').removeClass('d-none');
                $('#js-contacts .card-body + .card-body').removeClass('show');
            }

        });

        //initialize filter
        initApp.listFilter($('#js-contacts'), $('#js-filter-contacts'));
    });

</script>
</html>
