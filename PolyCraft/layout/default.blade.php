<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>{{ $website }} - {{ $title }}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="Alfiory">
        <meta name="description" content="{{ $config['description_website'] }}" >
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/png" href="<?php echo e($config['favicon']); ?>">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"/>

        <?= $todyxe->js('myjquery.min') ?>

        <?= $todyxe->css('mybootstrap.min') ?>
        <?= $todyxe->css('swiper.min') ?>
        <?= $todyxe->css('polycraft') ?>
    </head>

    <body>
        @extends('fetch.fetch')

        <?= $todyxe->blade('header') ?>

        <div class="pc-wrapper">
            <div class="bg-image" style="background-image: url('<?=$perso['background-image']?>');"></div>
            <?php echo $fetch_all; ?>
            @extends('integration.home')
        </div>

        <?= $todyxe->blade('footer') ?>
        <?= $todyxe->blade('modal') ?>
    </body>

    <?= $todyxe->js('mybootstrap.min') ?>
    <?= $todyxe->js('swiper.min') ?>
    <script src="https://www.google.com/recaptcha/api.js"></script>
    <?= $todyxe->js('polycraft') ?>
</html>