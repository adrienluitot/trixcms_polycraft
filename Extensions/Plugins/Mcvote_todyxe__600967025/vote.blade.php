<link href="@ThemeAssets('css/vote.css')" rel="stylesheet">

<div class="vote">
    <div class="container">
        <h2 class="page-title"><span>{{trans('theme::general.vote_title')}}</span></h2>

        @if(session()->has('success') || session()->has('error'))
            <div class="col-12 mb-5">
                @if(session()->has('success'))
                    <div class="alert alert-success">{{ session()->get('success') }}</div>
                @endif

                @if(session()->has('error'))
                    <div class="alert alert-danger">{{ session()->get('error') }}</div>
                @endif
            </div>
        @endif

        @isLogin
            @if(count($waitingRewards))
                <div class="alert alert-info mb-5"><i class="fas fa-check"></i> {!! trans('mcvote_todyxe::vote.home.0') !!}.</div>
            @endif
        @endIsLogin

        <div class="col-12">
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active py-2 px-4 row" id="step1" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div id="ajax-message-step1"></div>
                    <form id="step1_form" class="text-center">
                        @isLogin()
                            <input type="hidden" id="username" value="{{ user()->pseudo }}">
                        @else
                            <label>{{ trans('mcvote_todyxe::vote.home.5') }}</label>

                            <div class="pc-form col-md-8 offset-md-2 col-lg-6 offset-lg-3 mb-10">
                                <input type="text" id="username" placeholder="{{ trans('mcvote_todyxe::vote.home.5') }}" class="form-control text-center">
                            </div>
                        @endIsLogin

                        <button type="submit" id="button-addon2" class="btn btn-main w-100 vote-btn">{{trans('theme::general.vote')}}</button>

                        <input type="hidden" id="save_username" value="">
                    </form>
                </div>
                <div class="tab-pane fade py-2 px-4" id="step2" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div id="ajax-message-step2"></div>
                    <div class="servers">
                        <div class="waiting">
                            <div class="waiting-content">
                                <i class="fas fa-circle-notch fa-spin fa-3x"></i>
                            </div>
                        </div>

                        <div class="server col-md-4">
                            <span class="server-name">{{trans('theme::general.websites')}}</span>

                            <div class="websites">
                                @foreach($websites as $website)
                                    <button href="#" class="vote-website" onclick="cWebsite({{ $website->id }})" target="_blank">{{ $website->name }}</button>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <input type="hidden" id="save_website" value="">
                </div>
                <div class="tab-pane fade py-2 px-4" id="step3" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <div id="ajax-message-step3"></div>
                    <div class="text-center">
                        <div class="col-12">
                            <button onclick="step3_vote_now()" class="btn btn-main mb-3">{{ trans('mcvote_todyxe::vote.home.6') }}</button>
                        </div>
                        <div class="col-12">
                            <button onclick="step3_vote_after()" class="btn btn-light">{{ trans('mcvote_todyxe::vote.home.7') }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row vote-infos">
            <div class="col-md-10 offset-md-1 col-lg-6 offset-lg-0">
                <div class="rewards pc-table-responsive">
                    <ul class="pc-table">
                        <li class="head">
                            <ul>
                                <li class="reward-proba">{{trans('theme::general.chance')}}</li><!--
                                --><li class="reward-name">{{trans('theme::general.reward')}}</li>
                            </ul>
                        </li>

                        <li class="body">
                            @foreach($rewards as $reward)
                                <ul>
                                    <li class="reward-proba">{{ $reward->pourcent }}%</li>
                                    <li class="reward-name">{{ $reward->name }}</li>
                                </ul>
                            @endforeach
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-10 offset-md-1 col-lg-6 offset-lg-0">
                <div class="classement pc-table-responsive">
                    <ul class="pc-table">
                        <li class="head">
                            <ul>
                                <li class="vote-place">#</li><!--
                                --><li class="vote-player">{{trans('theme::general.player')}}</li><!--
                                --><li class="vote-count">{{trans('theme::general.votes')}}</li>
                            </ul>
                        </li>

                        <li class="body">
                            @php $i = 0; @endphp
                            @foreach($rankings->take(15) as $ranking)
                                <ul>
                                    <li class="vote-place">{{ ++$i }}<sup><?= ($i==1)? 'er': 'ème'; ?></sup></li>
                                    <li class="vote-player">
                                        <div class="hex-head">
                                            <img src="{{ avatar($ranking->user_id) }}" alt="{{ user($ranking->user_id)->pseudo }}">
                                        </div>

                                        {{ user($ranking->user_id)->pseudo }}
                                    </li>
                                    <li class="vote-count">{{ $ranking->getUserVotes() }}</li>
                                </ul>
                            @endforeach
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@isLogin
    <!-- WaitingRewards Modal -->
    <div class="modal fade" id="waitingRewards_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ trans('mcvote_todyxe::vote.home.7') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @foreach($waitingRewards as $r)
                            <div class="col">
                                <form method="POST" action="{{ route('mcvote.home.reward.after.getting') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $r->id }}">
                                    <button style="width: 100%" class="btn btn-success">{{ $r->rewards[0]->name }}</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endIsLogin

<script>
    const STEP1 = {
        "body": $('#step1'),
        "alert": $('#step1_alert')
    };
    const STEP2 = {
        "body": $('#step2'),
        "alert": $('#step2_alert')
    };
    const STEP3 = {
        "body": $('#step3'),
        "alert": $('#step3_alert')
    };

    const LOADING_MESSAGE = "{{ trans('mcvote_todyxe::vote.loading') }}";

    const STEP1_URI_POST = "{{ route('mcvote.home.step1') }}";
    const STEP2_URI_CW_POST = "{{ route('mcvote.home.step2') }}";
    const STEP2_URI_CHECK_POST = "{{ route('mcvote.home.step2.check.api') }}";
    const STEP3_URI_NOW_POST = "{{ route('mcvote.home.step3.now') }}";
    const STEP3_URI_AFTER_POST = "{{ route('mcvote.home.step3.after') }}";
</script>

<script src="@ThemeAssets('js/vote.js')"></script>