<div class="container">
    <h2 class="page-title"><span>{{ $page->name }}</span></h2>

    <div class="news-content">
        <div class="col-12">
            {!! $page->description() !!}
        </div>

        <small>{{trans('theme::general.by')}} <b>{{$page->author()}}</b> {{trans('theme::general.the')}} {{ \Carbon\Carbon::parse($page->created_at)->isoFormat("LL") }}</small>
    </div>
</div>