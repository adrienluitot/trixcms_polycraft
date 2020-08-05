<div class="container">
    <h2 class="page-title"><span>{{ $page['name'] }}</span></h2>

    <div class="news-content">
        <div class="news-text"><?= htmlspecialchars_decode(base64_decode($page['description'])) ?></div>

        <span class="news-info">Par <b>{{ (new \App\User())->where('id', $page['id_author'])->first()['pseudo']  }}</b> le {{ $page['created_at']->format('d/m/Y à h\hi') }}</span>

        <?= $tronai->loadModuleView() ?>
    </div>
</div>