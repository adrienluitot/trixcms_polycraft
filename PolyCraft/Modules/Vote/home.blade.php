<?= $todyxe->css('vote') ?>

<div class="vote">
    <div class="container">
        <h2 class="page-title"><span>Vote</span></h2>
        <div class="objectif">
            @if($vote_config['objectif'] != null)
                @if($vote_total >= $vote_config['objectif'])
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                            Objectif atteint !
                        </div>
                    </div>
                @else
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{ $vote_total }}" aria-valuemin="0" aria-valuemax="{{ $vote_config['objectif'] }}" style="width: {{ $vote_total / $vote_config['objectif'] * 100 }}%"></div>
                        <span>{{ $vote_total }} / {{ $vote_config['objectif'] }} votes</span>
                    </div>
                @endif
            @endif
        </div>           
         
        <div id="vote_1" style="display: block;">
            <div id="fetch-message-1"></div>
            @if($vote_config['playerConnect'])
                @if($auth->check())
                    <input type="hidden" id="pseudo_step1" value="{{ $user['pseudo'] }}">
                    <button class="btn btn-main w-100 vote-btn">Voter !</button>
                @else
                    <div class="alert alert-warning">Vous devez être connecté afin de pouvoir voter.</div>
                @endif
            @else
                @if($auth->check())
                    <input type="hidden" id="pseudo_step1" value="{{ $user['pseudo'] }}">
                @else
                    <div class="pc-form col-md-8 offset-md-2 col-lg-6 offset-lg-3 mb-10">
                        <input type="text" id="pseudo_step1" value="{{ $user['pseudo'] }}" placeholder="Votre pseudo..." class="form-control text-center">
                    </div>
                @endif

                <button class="btn btn-main w-100 vote-btn">Voter !</button>
            @endif
        </div>

        <div id="vote_2" style="display: none;">
            <input type="hidden" id="pseudo-step2">
            <div id="fetch-message-2"></div>
            <div class="servers">
                @foreach($vote_servers as $vote_server)
                    <div class="server col-md-4">
                        <span class="server-name">{{ $vote_server['name'] }}</span>
                        
                        <div class="websites">
                            @foreach($vote_websites as $vote_website)
                                @php
                                    $iTWebsite = $vote_user->where('user_id', $user['id'])->where('website_id', $vote_website['id'])->first()['iTWebsite'];
                                @endphp
                                @if(\Carbon\Carbon::now() >= $iTWebsite)
                                    <a class="vote-website" data-server-id="{{ $vote_server['id'] }}" data-id="{{ $vote_website['id'] }}" href="{{ $vote_website['url'] }}" target="_blank">{{ $vote_website['name'] }}</a>
                                @else
                                    <a class="disabled">{{ $vote_website['name'] }} - {{ \Carbon\Carbon::make($iTWebsite)->diffForHumans() }}</a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endforeach
                <div class="waiting">
                    <div class="waiting-content">
                        <i class="fas fa-circle-notch fa-spin fa-3x"></i>
                        <span id="the-final-countdown">15</span>
                    </div>
                </div>
            </div>
            <div id="rewards">

            </div>
        </div>


        <div class="row vote-infos">
            <div class="col-md-10 offset-md-1 col-lg-6 offset-lg-0">
                <div class="classement pc-table-responsive">
                    <ul class="pc-table">
                        <li class="head">
                            <ul>
                                <li class="vote-place">#</li><!--
                            --><li class="vote-player">Joueur</li><!--
                            --><li class="vote-count">Votes</li>
                            </ul>
                        </li>
            
                        <li class="body">
                            @php $i = 0; @endphp
                            @foreach($vote_rankings as $vote_ranking)
                                <ul>
                                    <li class="vote-place">{{ ++$i }}<sup><?= ($i==1)? 'er': 'ème'; ?></sup></td>
                                    <li class="vote-player">
                                        <div class="hex-head">
                                            <img src="https://minotar.net/avatar/{{ getUserData($vote_ranking['user_id'], 'pseudo') }}/28">
                                        </div>

                                        {{ getUserData($vote_ranking['user_id'], 'pseudo') }}
                                    </li>
                                    <li class="vote-count">{{ $vote_ranking['vote'] }}</li>
                                </ul>
                            @endforeach
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-10 offset-md-1 col-lg-6 offset-lg-0">
                <div class="rewards pc-table-responsive">
                    <ul class="pc-table">
                        <li class="head">
                            <ul>
                                <li class="reward-proba">Chance</li><!--
                            --><li class="reward-name">Récompense</li><!--
                            --><li class="reward-server">Serveur</li>
                            </ul>
                        </li>
            
                        <li class="body">
                            @php $i = 0; @endphp
                            @foreach($vote_rewards as $vote_reward)
                                <ul>
                                    <li class="reward-proba">{{ $vote_reward['pourcent'] }}%</td>
                                    <li class="reward-name">{{ $vote_reward['name'] }} @if($vote_reward['points'] > 0) (+{{ $vote_reward['points'] }} {{ $config['pbs'] }}) @endif</li>
                                    <li class="reward-server">{{ $vote_rewards_serv->where('type', 1)->where('id', $vote_reward['serverid'])->first()['name'] }}</li>
                                </ul>
                            @endforeach
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $todyxe->js('vote') ?>