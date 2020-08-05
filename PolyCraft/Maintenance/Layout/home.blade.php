<?= $todyxe->css('maintenance') ?>


<div class="container maintenance">
    <h2>Maintenance</h2>

    <div class="content">
        <div class="row justify-content-center">
            <div class="col-md-4 col-lg-3 text-center">
                <img src="{{$perso['logo']}}" class="logo">
            </div>
        </div>

        <h3>{{$maintenance['name']}}</h3>

        <div class="text">{!! htmlspecialchars_decode(base64_decode($maintenance['description'])) !!}</div>
    </div>
</div>