<?= $todyxe->css('home') ?>

<div id="carousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <?php 
            $i = 0;
            foreach ($sliders as $slider):
         ?>
            <li data-target="#carousel" data-slide-to="{{ $i }}"{{ ($slider['id']==$firstSlider['id'])?' class="active"':'' }}></li>
        <?php 
                $i++;
            endforeach;
         ?>
    </ol>

    <div class="carousel-inner">
        @foreach($sliders as $slider)
            <div class="carousel-item{!! ($slider['id']==$firstSlider['id'])?' active':'' !!}">
                <img src="{{ $slider['img_source'] }}" class="d-block w-100">

                <div class="carousel-caption d-none d-md-block">
                    <h5>{{ $slider['title'] }}</h5>
                    <p>{{ $slider['subtitle'] }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <div class="carousel-control-prev">
        <a href="#carousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </a>
    </div>
    <div class="carousel-control-next">
        <a href="#carousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </a>
    </div>
</div>

<div class="stats">
    <div class="stat-container">
        <div class="stat-inner">
            <i class="fas fa-eye"></i>
            <span class="stat-count">{{ $visitors['get'] }}</span>
            <span class="stat-name">Vues</span>
        </div>
    </div>

    <div class="stat-container">
        <div class="stat-inner">
            <i class="fas fa-gamepad"></i>
            <span class="stat-count">{{ $servers['online'] }}</span>
            <span class="stat-name">Joueur<?= ($servers['online'] > 1)? 's': ''; ?> en ligne</span>
        </div>
    </div>

    <div class="stat-container">
        <div class="stat-inner">
            <i class="fas fa-users"></i>
            <span class="stat-count">{{ $register }}</span>
            <span class="stat-name">Inscrits</span>
        </div>
    </div>
</div>

<div class="news">
    <h2><span>News</span></h2>

    <?php if($news_count): ?>
        <div class="swiper-main">
            <div class="swiper-container">
                <div class="swiper-wrapper<?= ($news_count < 3)? ' no-pagination': '' ?>">
                    @foreach($news as $new)
                        <div class="swiper-slide<?= ($news_count < 3)? ' col-lg-4 col-md-6': '' ?>">
                            <div class="news-item">
                                <div class="img-container">
                                    <img src="{{ $new['img'] }}">
                                </div>
                                <div class="news-container">
                                    <span class="news-stats">
                                        {{ $allCommentary->where('id_news', $new['id'])->count() }} <i class="fas fa-comments"></i>
                                    </span>
                                    <a class="news-title" href="{{ url()->to('/news/' . $new['slug']) }}">{{ $new['title'] }}</a>
                                    <span class="news-hour">{{ \Carbon\Carbon::make($new['created_at'])->diffForHumans() }}</span>
                                    <p><?= \Illuminate\Support\Str::limit(strip_tags(htmlspecialchars_decode(base64_decode($new['description']))), 200, '...'); ?></p>
                                    <a class="btn btn-main" href="{{ url()->to('/news/' . $new['slug']) }}">Lire plus</a>
                                </div>
                            </div>
                        </div>
                    @endforeach      
                </div>
            </div>

            @if($news_count >= 3)
                <div class="swiper-pagination"></div>

                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            @endif
        </div>
    <?php else: ?>
        <div class="alert alert-danger m-0">{{ $Lang->choose('NONEWSDETECTED_NEWS_ADMINCONTROLLER') }}</div>
    <?php endif; ?>
</div>

@if($news_count >= 3)
<script>
$(document).ready(function () {
    var newsSlider = new Swiper('.swiper-container', {
        slidesPerView: <?= ($news_count < 3)? $news_count : '3'; ?>,
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
                slidesPerView: <?= ($news_count < 2)? $news_count : '2'; ?>,
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