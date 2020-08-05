<?= $todyxe->css('news') ?>

<div class="container">
    <h2 class="page-title"><span>{{ $blog['title'] }}</span></h2>

    <div class="news-content">
        <div class="img-container"><img src="{{ $blog['img'] }}"></div>

        <div class="news-text">{!! htmlspecialchars_decode(base64_decode($blog['description'])) !!}</div>

        <span class="news-info">Par <b>{{ $blog['author'] }}</b> le {{ $blog['created_at']->format('d/m/Y à h\hi') }}</span>
    </div>

    <div class="news-comments col-md-10 offset-md-2">
        @if($commentary->count())
            @foreach($commentary as $comment)
            <div class="comment{{ ($comment->author == $blog['author'])? ' news-author':'' }}">
                    <span class="comment-author"><img class="hex-head" src="https://minotar.net/avatar/{{ $comment->author }}/36"> {{ $comment->author }}</span>
                    <div class="comment-content">
                        {{ base64_decode($comment->commentaire) }}
                    </div>
                    <div class="comment-footer">
                        <span class="comment-date">le {{$comment->created_at->format("d/m/Y à H:i:s")}}</span>
                        @if($isLogin)
                            <button class="add-like btn btn-{{ ($comment->author == $blog['author'])? 'main':'light' }}" data-id="{{ $comment->id }}"><i class="fas fa-thumbs-up" aria-hidden="true"></i> <span>{{ $comment->like }}</span></button>
                        @else
                            <span class="btn btn-{{ ($comment->author == $blog['author'])? 'main':'light' }}"><i class="fas fa-thumbs-up" aria-hidden="true"></i> {{ $comment->like }}</span>
                        @endif
                    </div>
                </div>
            @endforeach
        @else
            <div class="alert alert-info">Aucun commentaire n'a encore été posté.</div>
        @endif
    </div>

    <div class="add-comment col-md-10 offset-md-2">
        @if($isLogin)
            <div id="fetch-message"></div>

            <form method="POST" id="add_commentary_news">
                <div class="pc-form textarea">
                    <textarea id="comment" rows="4" name="comment" class="form-control" autocomplete="off"></textarea>
                </div>
                
                <input type="hidden" name="slug" id="slug" value="{{ Request()->route('slug') }}">

                <input type="submit" name="send_add_commentary_news" id="send_add_commentary_news" class="btn btn-main">
            </form>
        @else
            <div class="alert alert-warning">Vous devez être connecté pour poster un message.</div>
        @endif
    </div>
</div>

@if($isLogin)
<?= $todyxe->js('news') ?>
@endif
