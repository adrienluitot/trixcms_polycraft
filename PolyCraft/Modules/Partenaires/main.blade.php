<?= $todyxe->css('partenaires') ?>

<div class="container">
    <h1 class="text-center">Partenaires</h1>

    <div class="row">
        @foreach ($partners as $partner)    
            <div class="col-md-4 col-sm-6 partner">
                <a href="{{$partner->link}}" class="img-link"><img alt="{{$partner->name}}" src="{{$partner->image}}"></a>
                <a href="{{$partner->link}}" target="_blank"><i class="fa fa-link"></i> {{$partner->link}}</a>
                <span class="name">{{$partner->name}}</span>
                <p class="desc">{{$partner->description}}</p>
            </div>
        @endforeach
    </div>
</div>
