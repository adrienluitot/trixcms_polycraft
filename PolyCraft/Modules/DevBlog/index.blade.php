{!! $todyxe->css('devblog') !!}

<div class="container">
    <h2 class="page-title"><span>Dev Blog</span></h2>

    <div class="pc-table-responsive">
        <ul class="pc-table devblog-table">
            <li class="head">
                <ul>
                    <li class="devblog-title">Titre</li><!--
                --><li class="devblog-version">Version</li><!--
                --><li class="devblog-content">Infos</li>
                </ul>
            </li>

            <li class="body">
                <?php  $total = 0;  ?>
                @if(sizeof($list) > 0)
                    @foreach($list as $blog)
                        <ul>
                            <li class="devblog-title">{{ $blog['titre'] }}</li><!--
                        --><li class="devblog-version">{{ $blog['version'] }}</li><!-- 
                        --><li class="devblog-content">{!! $blog['content'] !!}</li>
                        </ul>
                    @endforeach
                @else
                    <ul>
                        <li>Vous n'avez aucun article dans votre panier..</li>
                    </ul>
                @endif
            </li>
        </ul>
    </div>
</div>
