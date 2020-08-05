<?= $todyxe->css('shop') ?>

<?php 
    if($param != "FIRST")
        $motherCat = $shop_subcategory->where('id', $param)->get()[0]->category;
 ?>

<div class="categories" style="background-image: url('<?= $perso["shop-cats-background"] ?>');">
    <div class="blur"></div>
    @foreach($shop_category as $c)
        <div class="cat-master">
            <a href="#" class="hexagon cat{{ (isset($motherCat) && $c->id == $motherCat)? ' active':'' }}"><span>{{ $c->name }}</span></a>
            @foreach($shop_subcategory->where('category', $c->id)->get() as $sc)
                <a class="hexagon subcat{{ ($param != "FIRST" && $sc->id == $param)? " active":"" }}" lang="en" href="{{ route('Shop / Home / SC', ['subcategorie' => $sc->id]) }}"><span>{{ $sc->name }}</span></a>
            @endforeach
        </div>
    @endforeach
</div>

<div class="infos">
    <?php if($isLogin): ?>
        <div class="infos-cat"><a href="{{ route('Shop / Basket') }}">Voir le panier</a></div>
        <div class="infos-cat">Vous avez <span id="money-count">{{ $user['money'] }}</span> {{ ($user['money'] >1)? $config['pbs'] : $config['pbs'] }}</div>
        <div class="infos-cat"><a href="{{ route('Shop / Payment') }}">Acheter des {{ $config['pbs'] }}</a></div>
    <?php else: ?>
        <a href="/users/login">Connectez-vous pour voir vos points</a>
    <?php endif; ?>
</div>


<div class="container shop-main" style="clear: both;">
    <div class="row">
        @if(isset($shop_promos) && $shop_promos->count())
            <div class="col-12">
                @foreach($shop_promos as $promo)
                    <div class="alert alert-warning promo-code">Un nouveau code promotionnel de {{ $promo->pourcent }}% est disponible le voici : {{ $promo->code }}.</div>
                @endforeach
            </div>
        @endif

        <div class="col-lg-3">
            @if($shop_config['objectif'])
                <div class="shop-widget">
                    <div class="shop-widget-header">
                        Objectif
                    </div>
                    <div class="shop-widget-content">
                        @php $goalPercent = $s_objectif / $shop_config['objectif'] * 100; @endphp
                        <div class="hexagon-progress">
                            <span class="hexagon-progress-text">{{ $goalPercent }}%</span>
                            <div class="hexagon-progress-back" style="height: calc({{ $goalPercent}}% + 4px)"></div>
                            <div class="hexagon-progress-back" style="height: calc({{ $goalPercent }}% + 4px)"></div>
                        </div>
                        <span class="shop-goal">{{ $s_objectif }} / {{ $shop_config['objectif'] }}</span>
                        @if($perso['shop-goal-text'] != "false")
                            <div class="shop-goal-text">
                                <?= $perso['shop-goal-text'] ?>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
            
            <div class="shop-widget">
                <div class="shop-widget-header">
                    Meilleurs acheteurs
                </div>
                <div class="shop-widget-content widget-best-buyers">
                    @if($shop_module_bestbuyers->count())
                        <?php $i = 0; ?>
                        @foreach($shop_module_bestbuyers as $bestbuyer)
                            <?php ++$i; ?>
                                <div class="best-buyer">
                                    <div class="hex-head">
                                        <img src="{{ $minecraft->getProfil(getUserData($bestbuyer->user_id, 'pseudo')) }}" width="100%" style="border-radius:50%;">
                                    </div>
                                    <div class="best-buyer-infos">
                                    <span class="best-buyer-name"><span class="bb-rank bb-n{{ $i }}"><i class="fas fa-trophy"></i></span> {{ getUserData($bestbuyer->user_id, 'pseudo') }}</span>
                                        <span class="best-buyer-spent">{{ DB::table('shop__user__buy__article')->where('user_id', $bestbuyer->user_id)->sum('total_give_money') }} {{ $config['pbs'] }}</span>
                                    </div>
                                </div>
                        @endforeach
                    @else
                        Aucun achat n'a encore été effectué...
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="shop-items row">
                <?php $articles = ($param != "FIRST")? $shop_articles->where('show', 1)->where('subcategory', $param)->get() : $articles = $shop_articles->where('show', 1)->where('subcategory', $shop_subcategory->first()['id'])->get(); ?>

                @if($articles->count())
                    @foreach($articles as $shop_article)
                        <div class="col-sm-6 col-md-4">
                            <a href="{{ route('Shop / Product', ['id' => $shop_article->id]) }}" class="shop-item">
                                <div class="img-container">
                                    <img src="{{ $shop_article->url }}" alt="{{ $shop_article->name }}">
                                </div>
                                <div class="caption">
                                    <div class="item-band">
                                        <span class="item-name">{{ $shop_article->name }}</span>
                                        <span class="item-price"><span class="item-price-nb">{{ $shop_article->price }}</span> {{ $config['pbs'] }}</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @else
                    <div class="alert alert-warning alert-dismissible fade show">
                        <span class="fa-stack fa-1x">
                            <i class="fas fa-store fa-stack-1x"></i>
                            <i class="fas fa-ban fa-stack-2x" style="color:Tomato"></i>
                        </span>
                        Oups... Aucun article n'a été trouvé.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>