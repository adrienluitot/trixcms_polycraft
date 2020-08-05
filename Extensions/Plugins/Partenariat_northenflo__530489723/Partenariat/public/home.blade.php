<link href="@ThemeAssets('css/partners.css')" rel="stylesheet">


<div class="container">
    <h2 class="page-title"><span>{{trans('theme::general.partners')}}</span></h2>


    <div class="row">
        @foreach ($partners as $partner)
            <div class="col-md-4 col-sm-6 partner">
                <a href="{{$partner->link}}" class="img-link"><img alt="{{$partner->name}}" src="{{$partner->image}}"></a>
                <a href="{{$partner->link}}" target="_blank"><i class="fa fa-link"></i> {{$partner->link}}</a>
                <span class="name">{{$partner->name}}</span>
                <p class="desc">{!! $partner->description !!}</p>
            </div>
        @endforeach
    </div>
</div>
