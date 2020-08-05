<!DOCTYPE html>
    <html>
        <head>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

            <meta name="csrf-token" content="{{ csrf_token() }}">

            <meta name="title" content="{{ website() }}">
            <meta name="description" content="{{ site_config('description') }}">
            <meta name="keywords" content="{{ site_config('keywords') }}">
            <meta name="robots" content="index, follow">
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
            <meta name="author" content="Adrien Luitot">

            <meta name="og:title" content="{{ website() }}"/>
            <meta name="og:type" content="game"/>
            <meta name="og:url" content="{{ url()->current() }}"/>
            <meta name="og:image" content="{{ site_config('favicon') }}"/>
            <meta name="og:site_name" content="{{ website() }}"/>
            <meta name="og:description" content="{{ site_config('description_website') }}"/>

            <script src="@ThemeAssets('js/myjquery.min.js')"></script>

            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.1/css/all.css"/>

            <link href="@ThemeAssets('css/mybootstrap.min.css')" rel="stylesheet">
            <link href="@ThemeAssets('css/swiper.min.css')" rel="stylesheet">
            <link href="@ThemeAssets('css/polycraft.css')" rel="stylesheet">
        </head>

        <body>
            <div id="header">
                <nav class="navbar navbar-expand-lg fixed-top">
                    <a class="navbar-brand" href="/">
                        <img alt="{{website()}}" src="{{theme()->config('website_logo')}}" class="d-inline-block align-top">
                    </a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="collapse navbar-collapse" id="navbar">
                        <ul class="navbar-nav main-links ml-auto mr-auto">
                            @foreach($navbars as $n)
                                @if($n->isSimple())
                                    <li class="nav-item{{(url()->current() == url($n->link))? " active" : ""}}">
                                        <a class="nav-link" href="{{ url($n->link) }}" @if($n->open_blank) target="_blank" @endif>{{ $n->name }}</a>
                                    </li>
                                @else
                                    <li class="nav-item dropdown">
                                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" id="dropdown{{ $n->name }}">{{ $n->name }}<span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            @foreach($n->childs as $menu)
                                                <li><a href="{{ url($menu->link) }}" @if($menu->open_blank) target="_blank" @endif><span>{{ $menu->name }}</span></a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif
                            @endforeach
                        </ul>

                        <ul class="navbar-nav account-zone">
                            @if(tx_auth()->isLogin())
                                <li class="nav-item"><a class="nav-link" href="{{ action('Auth\User\ProfileController@home') }}"><img src="{{ avatar(user()->id) }}" style="height: 20px;border-radius:50%;"> <span class="d-inline-block d-lg-none">{{trans('theme::general.profil')}}</span></a></li>

                                <li class="nav-item">
                                    <a class="nav-link notif-link" href="#" data-toggle="modal" data-target="#tx_notifications">
                                        <i class="fas fa-bell d-none d-lg-inline"></i><span class="d-block d-lg-none">{{trans('theme::general.notifications')}}</span>
{{--                                        @if($lnotifs->count())--}}
{{--                                            <span class="notification-count">{{ $lnotifs->count() }}</span>--}}
{{--                                        @endif--}}
                                    </a>
                                </li>

                                @if(user()->isAdmin() || user()->hasPermission('ACCESS__DASHBOARD'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ action('Admin\HomeController@home') }}"><i class="fas fa-cogs"></i> <span class="d-inline-block d-lg-none">{{trans('theme::general.admin_panel')}}</span></a>
                                    </li>
                                @endif

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ action('Auth\User\ProfileController@logout') }}"><i class="fas fa-power-off d-none d-lg-inline"></i><span class="d-block d-lg-none">{{trans('theme::general.lgout')}}</span></a>
                                </li>
                            @else
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-user"></i>
                                    </a>
                                    <div class="dropdown-menu connection-dropdown" aria-labelledby="navbarDropdownMenuLink">
                                        <a class="dropdown-item" href="{{ action('Auth\User\LoginController@userLogin') }}"><span>{{trans('theme::general.sign_in')}}</span></a>
                                        <a class="dropdown-item" href="{{ action('Auth\User\RegisterController@userRegister') }}"><span>{{trans('theme::general.sign_up')}}</span></a>
                                    </div>
                                </li>
                            @endif
                        </ul>
                    </div>
                </nav>
            </div>

            <div class="pc-wrapper">
                <div class="bg-image" style="background-image: url('{{ theme()->config('all_pages_splashart_url') }}');"></div>
