<?= $todyxe->css('shop') ?>

<div class="container">
    <div class="alert alert-{{ session()->get('alert') }}">{{ session()->get('message') }}</div>
    <div id="fetch-message"></div>

    <div class="">
        <a class="btn btn-main" href="/shop"><i class="fas fa-chevron-left"></i> Retourner à la boutique</a>
    </div>

    <div class="pc-table-responsive">
        <ul class="pc-table">
            <li class="head">
                <ul>
                    <li class="basket-name">Nom</li><!--
                --><li class="basket-price">Prix</li><!--
                --><li class="basket-server">Serveur</li><!--
                --><li class="basket-quantity">Quantité</li><!--
                --><li class="basket-action"><i class="fas fa-cog"></i></li>
                </ul>
            </li>

            <li class="body">
                <?php  $total = 0;  ?>
                @if($shop_articles)
                    @foreach($shop_articles as $shop_article)
                        <ul>
                            <li class="basket-name">{{ $shop_article['name'] }}</li><!--
                        --><li class="basket-price">
                                @if(session()->has('shop.promotion.promo-' . $shop_article['id']))
                                    <?php  $realPrice = session()->get('shop.promotion.promo-' . $shop_article['id'])['reduction'];  ?>
                                    <span class="old-price">{{ $shop_article['price'] }}</span>
                                    <b><span class="new-price">{{ $realPrice }}</span> {{ $config['pbs'] }}</b>
                                    <a href="#" class="remove-promo" data-url="{{ route('POST_Shop_Delete_PromoCode', ['slug' => 'shop.promotion.promo-' . $shop_article['id']]) }}>" title="Supprimer la promotion"><i class="fas fa-times"></i></a>
                                @else
                                    {{ $shop_article['price'] . " " . $config['pbs'] }}
                                @endif
                            </li><!--
                        --><li class="basket-server">{{ $shop_article['server'] }}</li><!--
                        --><li class="basket-quantity">x{{ $shop_article['stock'] }}</li><!--
                        --><li class="basket-action">
                                <form method="POST" action="{{ route('POST_Shop_Delete_ArticleOnBasket', ['id' => $shop_article['id']]) }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <button type="submit" style="background:none;border: none;color: tomato;">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </li>
                        </ul>
                        <?php 
                            $total += ((session()->has('shop.promotion.promo-' . $shop_article['id']))? $realPrice : $shop_article['price']) * $shop_article['stock'];
                         ?>
                    @endforeach
                @else
                    <ul>
                        <li>Vous n'avez aucun article dans votre panier..</li>
                    </ul>
                @endif
            </li>
        </ul>
    </div>

    <div class="basket-total">Total : <b> <span id='basket-total'>{{ $total }}</span> {{ ($total > 1)? $config['pbs'] : $config['pb'] }}</b></div><!--
    --><button id="send" class="basket-pay">Payer</button>
</div>
<script>var TOKEN = "<?php echo e(csrf_token()); ?>";</script>
<?= $todyxe->js('shop') ?>

<script>
document.addEventListener('DOMContentLoaded', function () {
    $('#send').on('click', function (e) {
        $('#fetch-message').html('<div class="alert alert-info">Chargement en cours... Veuillez patienter.</div>');
        e.preventDefault();
        fetch('<?php echo e(route('Fetch_Shop_Buy_OnBasket', ['data' => encrypt(serialize(session()->get('shop'))), 'total' => $total])); ?>', {
            method: 'post',
            credentials: "same-origin",
            headers: {
                'X-CSRF-TOKEN': TOKEN,
            }
        }).then(function (response) {

            return response.text();

        }).then(function (html) {
            // Success :)
            try {
                let request = JSON.parse(html);
                $('#fetch-message').html('<div class="alert alert-'+((request.alert == "error")? "danger":request.alert)+'"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + request.message + '</div>');
            } catch (e) {
                $('#fetch-message').html("<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button><?php echo e($Lang->choose('INTERNALEERROR')); ?></div>");
            }
        }).catch(function (err) {
            // Error :(
            console.log(err);
        });
    });
});
</script>