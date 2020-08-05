<?= $todyxe->css('shop'); ?>

<div class="container product">
    <?php if(session()->get('message')): ?>
        <div class="alert alert-{{ session()->get('alert') }}">{{ session()->get('message') }}</div>
    <?php endif; ?>

    <div class="row">
        <a class="btn btn-main mb-10" href="{{ route('Shop / Home') }}"><i class="fas fa-chevron-left"></i> Revenir à la boutique</a>
        <a class="btn btn-main mb-10" href="{{ route('Shop / Basket') }}"><i class="fas fa-shopping-basket"></i> Aller au panier</a>
        <span class="product-name">{{ $i['name'] }}</span>
    </div>

    <div class="row product-content">
        <div class="col-10 offset-1 col-sm-8 offset-sm-2 col-md-4 offset-md-0">
            <img src="{{ $i['url'] }}" width="100%">
        </div>

        <div class="col-md-8 product-content">
            <div id="fetch-message"></div>

            <span id="description">Description :</span>
            <div class="description"><?= htmlspecialchars_decode(base64_decode($i['description'])) ?></div>

            <?php if($isLogin): ?>

                <div class="pc-form">
                    <input type="text" data-url="{{ route('POST_Shop_AddOnBasket_Article', ['id' => $i['id']]) }}" placeholder="Code promotionnel" class="form-control" id="promo-code">
                </div>

                <?php if($i['multiachat']): ?>
                    <div class="pc-form number">
                        <input type="number" id="quantity" name="stock" class="form-control" value="1">
                    </div>
                <?php endif; ?>

                <a href="#" data-url="{{ route('POST_Shop_AddOnBasket_Article', ['id' => $i['id']]) }}" class="btn btn-main" id="add-to-cart">Ajouter au panier</a>
            <?php else: ?>
                <div class="alert alert-warning">Vous n'êtes pas connecté.</div>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="modal fade" data-backdrop="static" data-keyboard="false" id="added-to-cart" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title"></span>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <a type="button" href="{{ route('Shop / Home') }}" class="btn btn-light">Retourner aux articles</a>
                <a type="button" href="{{ route('Shop / Basket') }}" class="btn btn-main">Aller au panier</a>
            </div>
        </div>
    </div>
</div>

<div id="test-return" style="display: none;">
</div>

<script>var TOKEN = "{{ csrf_token() }}";</script>
<?= $todyxe->js('shop'); ?>