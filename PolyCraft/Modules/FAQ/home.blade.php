<?= $todyxe->css('faq') ?>

<div class="container">
    <h2 class="page-title"><span>FAQ</span></h2>

    @if($listExist)
        @foreach($lists as $list)
            <div class="faq-question">
                <a role="button" data-toggle="collapse" href="#faq-{{ $list['id'] }}" aria-expanded="false" aria-controls="test">
                    {{ $list['title'] }}
                </a>
            </div>
            <div class="collapse" id="faq-{{ $list['id'] }}">
                <div class="faq-answer">{{ $list['description'] }}</div>
            </div>
            <br>
        @endforeach
    @else
        <div class="alert alert-info">{{ $Module->LangChoose('FAQNODETECTFAQ') }}</div>
    @endif
</div>
