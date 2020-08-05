<link href="@ThemeAssets('css/home.css')" rel="stylesheet">


<div id="carousel" class="carousel slide" data-ride="carousel">
    {{-- <ol class="carousel-indicators">
        <?php
        $i = 0;
        foreach ($sliders as $slider):
        ?>
        <li data-target="#carousel" data-slide-to="{{ $i }}"{{ ($slider['id']==$firstSlider['id'])?' class="active"':'' }}></li>
        <?php
        $i++;
        endforeach;
        ?>
    </ol> --}}

    <div class="carousel-inner">
        {{-- @foreach($sliders as $slider)
            <div class="carousel-item{!! ($slider['id']==$firstSlider['id'])?' active':'' !!}">
                <img src="{{ $slider['img_source'] }}" class="d-block w-100">

                <div class="carousel-caption d-none d-md-block">
                    <h5>{{ $slider['title'] }}</h5>
                    <p>{{ $slider['subtitle'] }}</p>
                </div>
            </div>
        @endforeach --}}

        <div class="carousel-item active">
            <img src="{{ theme()->config('slider_url') }}" class="d-block w-100">
        </div>
    </div>

    {{-- <div class="carousel-control-prev">
        <a href="#carousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </a>
    </div>
    <div class="carousel-control-next">
        <a href="#carousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </a>
    </div> --}}
</div>

<div class="stats">
    <div class="stat-container">
        <div class="stat-inner">
            <i class="fas fa-eye"></i>
            <span class="stat-count">{{ visitors_count() }}</span>
            <span class="stat-name">{{trans('theme::general.views')}}</span>
        </div>
    </div>

    <div class="stat-container">
        <div class="stat-inner">
            <i class="fas fa-gamepad"></i>
            @if(egame()->if('tx_minecraft')->isEnable())
                <span class="stat-count">{{ $server['players']['online'] }}</span>
                <span class="stat-name">{{trans('theme::general.online_players')}}</span>
            @else
                <span class="stat-count">W.I.P</span>
                <span class="stat-name">Work In Progress</span>
            @endif
        </div>
    </div>

    <div class="stat-container">
        <div class="stat-inner">
            <i class="fas fa-users"></i>
            <span class="stat-count">{{ users_register_count()['all'] }}</span>
            <span class="stat-name">{{trans('theme::general.registered')}}</span>
        </div>
    </div>
</div>

<div class="news">
    <h2><span>{{trans('theme::general.news')}}</span></h2>

    @if($news->count() > 3)
        <div class="swiper-main">
            <div class="swiper-container">
                <div class="swiper-wrapper{{ ($news->count() < 3)? ' no-pagination': '' }}">
                    @foreach($news as $newsInfo)
                        <div class="swiper-slide{{ ($news->count() < 3)? ' col-lg-4 col-md-6': '' }}">
                            <div class="news-item">
                                <div class="img-container">
                                    <img src="{{ $newsInfo->img() }}" alt="{{$newsInfo->name}}">
                                </div>
                                <div class="news-container">
                                        <span class="news-stats">
                                            {{ $newsInfo->comment->count() }} <i class="fas fa-comments"></i>
                                        </span>
                                    <a class="news-title" href="{{ action("Component\App\BlogController@home", ['slug' => $newsInfo->slug]) }}">{{$newsInfo->name}}</a>
                                    <span class="news-hour">{{ \Carbon\Carbon::parse($newsInfo->created_at)->locale(app()->getLocale())->isoFormat('LL') }}</span>
                                    <p>{!! Str::limit($newsInfo->description(), 200, "...") !!}</p>
                                    <a class="btn btn-main" href="{{ action("Component\App\BlogController@home", ['slug' => $newsInfo->slug]) }}">{{trans('theme::general.read_more')}}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            @if($news->count()  >= 3)
                <div class="swiper-pagination"></div>

                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            @endif
        </div>
    @else
        <div class="alert alert-danger m-0">{{ __('theme_default.Pages.Home.AnyNews') }}</div>
    @endif
</div>

@if($news->count() >= 3)
    <script>
        $(document).ready(function () {
            var newsSlider = new Swiper('.swiper-container', {
                slidesPerView: <?= ($news->count() < 3)? $news->count() : '3'; ?>,
                spaceBetween: 30,
                slidesPerGroup: 1,
                loop: true,
                loopFillGroupWithBlank: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                breakpoints: {
                    1000: {
                        slidesPerView: <?= ($news->count() < 2)? $news->count() : '2'; ?>,
                        spaceBetween: 20,
                    },
                    700: {
                        slidesPerView: 1,
                        spaceBetween: 10,
                    }
                }
            });
            newsSlider.allowTouchMove = false;
        });
    </script>
@endif