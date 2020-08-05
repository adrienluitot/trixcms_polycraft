<link href="@ThemeAssets('css/news.css')" rel="stylesheet">

@if(request('slug') != null)
    <div class="container">
        <h2 class="page-title"><span>{{ $blog->name }}</span></h2>

        <div class="news-content">
            <div class="img-container"><img src="{{ $blog->img() }}"></div>

            <div class="news-text">{!! $blog->description() !!}</div>

            <span class="news-info">{{trans("theme::general.by")}} <b>{{ $blog->author() }}</b> {{trans("theme::general.the")}} {{ \Carbon\Carbon::parse($blog->created_at)->isoFormat('L') }}</span>
        </div>

        <hr class="mt-4">

        <div class="news-comments col-md-10 offset-md-2">
            @if($blog->comment->count())
                @foreach($blog->comment as $comment)
                    <div class="comment{{ ($comment->author() == $blog->author())? ' news-author':'' }}">
                        <span class="comment-author"><img class="hex-head" src="{{ avatar($blog->author('id')) }}"> {{ $comment->author() }}</span>
                        <div class="comment-content px-4">
                            {{ $comment->message() }}
                        </div>
                        <div class="comment-footer">
                            <span class="comment-date">{{trans("theme::general.the")}} {{ \Carbon\Carbon::parse($comment->created_at)->isoFormat('L ['.trans('theme::general.at').'] LT') }}</span>
{{--                            @if(tx_auth()->isLogin())--}}
{{--                                <button class="add-like btn btn-{{ ($comment->author() == $blog['author'])? 'main':'light' }}" data-id="{{ $comment->id }}"><i class="fas fa-thumbs-up" aria-hidden="true"></i> <span>{{ $comment->like }}</span></button>--}}
{{--                            @else--}}
{{--                                <span class="btn btn-{{ ($comment->author() == $blog->author())? 'main':'light' }}"><i class="fas fa-thumbs-up" aria-hidden="true"></i> {{ $comment->like }}</span>--}}
{{--                            @endif--}}
                        </div>

                        @if(tx_auth()->isLogin() && $comment->author('id') == user()->id || tx_auth()->isLogin() && user()->hasPermission('CAN__DELETE__COMMENT__NEWS|admin'))
                            <div class="delete-comment-zone">
                                <form method="POST" action="{{ action('Component\App\BlogController@delete_post') }}">
                                    @csrf
                                    <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                    <input type="hidden" name="slug" value="{{ $blog->slug }}">

                                    <button type="submit"><i class="fas fa-trash"></i></button>
                                </form>
                            </div>
                        @endif
                    </div>
                @endforeach
            @else
                <div class="alert alert-info">{{ __('theme_default.Pages.Blog.AnyComments') }}</div>
            @endif
        </div>

        <div class="add-comment col-md-10 offset-md-2 mt-3">
            @if(tx_auth()->isLogin())
                @if(user()->hasPermission('CAN__POST__COMMENT__NEWS|admin'))
                    @if(session()->has('comment'))
                        <div class="alert alert-{{ session()->get('comment.alert') }}">{{ session()->get('comment.message') }}</div>
                    @endif

                    <form method="POST" action="{{ action('Component\App\BlogController@post') }}">
                        @csrf
                        <div class="pc-form textarea">
                            <textarea rows="4" name="message" class="form-control" autocomplete="off"></textarea>
                        </div>

                        <input type="hidden" name="id" value="{{ $blog->id }}">

                        <button type="submit" class="btn btn-main">{{ __('messages.Form.Submit_Button') }}</button>
                    </form>
                @endif
            @else
                <div class="alert alert-warning">{{ __('theme_default.Pages.Blog.LoginIsRequiredForComment') }}</div>
            @endif
        </div>
    </div>
@else
    <div class="container">
        <h2 class="page-title"><span>{{ $title }}</span></h2>

        @if($news->count())
            <div class="row all-news">
                @foreach($news->orderByDesc('created_at')->get() as $newsInfo)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4 news-info">
                        <a class="news-img" style="background-image: url('{{ $newsInfo->img() }}');" href="{{ action("Component\App\BlogController@home", ['slug' => $newsInfo->slug]) }}"></a>
                        <div class="news-info-container">
                            <a href="{{ action("Component\App\BlogController@home", ['slug' => $newsInfo->slug]) }}">
                                <span class="news-title">{{ $newsInfo->name }}</span>
                            </a>

                            <div class="news-desc">
                                {!! Str::limit($newsInfo->description(), 80, '...') !!}
                            </div>

                            <small class="text-muted">{{trans('theme::general.by')}} {{ $newsInfo->author() }} {{trans('theme::general.the')}} {{ \Carbon\Carbon::parse($newsInfo->created_at)->isoFormat('L') }} - {{ $newsInfo->comment->count() }} <i class="fas fa-comments"></i></small>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="alert alert-danger"><i class="fas fa-times"></i> {{ __('theme_default.Pages.Blog.AnyNews') }}</div>
        @endif
    </div>
@endif