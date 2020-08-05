<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ $website }} - Maintenance</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Alfiory">
        <meta name="description" content="" >
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/png" href="{{ $config['favicon'] }}">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"/>


        <?= $todyxe->css('mybootstrap.min') ?>
        <?= $todyxe->css('polycraft') ?>
        <?= $todyxe->css('maintenance') ?>
        <link rel="stylesheet" type="text/css" href="{{ asset('/public/css/font-awesome.min.css') }}">
    </head>
    
    <body style="background-image: url(<?=$perso['background-image']?>);">
        <div class="bg-cover"></div>
        <div class="container ext-maintenance">
            <div class="maint">
                <h1 class="title">{{ $website }} est en maintenance</h1>

                <img alt="{{$website}}" src="{{$perso['logo']}}">

                <div class="contains">
                    {!! htmlspecialchars_decode(base64_decode($maintenance['description'])) !!}
                </div>
            </div>
        </div>
    </body>
</html>