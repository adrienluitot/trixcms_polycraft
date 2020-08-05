{!! $todyxe->css('play') !!}

<div class="container">
    <h2 class="page-title"><span>Staff</span></h2>
    
    @if($play['launcher'] == 1)
        <h3 class="title">Version <span class="color">{{ $play['version'] }}</span></h3>
        <div class="mc">
        Lancez <span>Minecraft</span>, allez dans <span>Multijoueurs</span> puis dans ajouter un <span>Serveur</span>.<br><br>
        <span class="ip">{{ $play['ip'] }}</span>
        </div>
    @elseif($play['launcher'] == 0)
        <div class="row launcher">
        <div class="col-lg-4">
            <a href="{{ $play['windows'] }}"><i class="fab fa-windows"></i></a>
        </div>
        <div class="col-lg-4">
            <a href="{{ $play['mac'] }}"><i class="fab fa-apple"></i></a>
        </div>
        <div class="col-lg-4">
            <a href="{{ $play['linux'] }}"><i class="fab fa-linux"></i></a>
        </div>
        </div>
    @else
        <div class="alert alert-danger">
        Une erreur est survenue !
        </div>
    @endif

    <h3 class="title">description</h3>
    <div class="content">
        {{ $play['description'] }}
    </div>
</div>
