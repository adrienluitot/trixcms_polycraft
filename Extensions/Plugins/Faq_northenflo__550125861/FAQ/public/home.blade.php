<link href="@ThemeAssets('css/faq.css')" rel="stylesheet">

<div class="container">
    <h2 class="page-title"><span>{{trans('theme::general.faq')}}</span></h2>

    @foreach($faqs as $faq)
        <h3>{{$faq->name}}</h3>

        <div class="accordion" id="faqp-{{Str::slug($faq->name)}}">
            @foreach($faq['questions'] as $faquestion)
                <div class="faq-question">
                    <a role="button" data-toggle="collapse" href="#faq-{{Str::slug($faquestion->question)}}" aria-expanded="false" aria-controls="test">
                        {{$faquestion->question}}
                    </a>
                </div>
                <div class="collapse" id="faq-{{Str::slug($faquestion->question)}}" data-parent="#faqp-{{Str::slug($faq->name)}}">
                    <div class="faq-answer">{{$faquestion->response}}</div>
                </div>
                <br>
            @endforeach
        </div>
    @endforeach
</div>
