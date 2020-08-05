<div class="profile-content">
    <div id="fetch-message"></div>

    <h3>Récompenses à récupérer</h3>

    @foreach($vote_servers as $vote_server)
        <div class="col-12 col-sm-6 col-md-4">
            <h4>{{ $vote_server['name'] }}</h4>

            @if($vote_rewards_after->where('user_id', $user['id'])->count())
                @foreach($vote_rewards_after->where('user_id', $user['id'])->where('server_id', $vote_server['id'])->get() as $vote_after)
                    @php
                        $vote_reward = $vote_rewards->where('id', $vote_after['reward_id'])->where('serverid', $vote_server['id'])->first();
                    @endphp

                    <button onclick="sendRequest('{{ route('POST_Vote_GetAfter_Rewards', ['id' => $vote_after['id']]) }}')" class="btn btn-success mb-10 w-100">{{ $vote_reward['name'] }} @if($vote_reward['points'] > 0) (+{{ $vote_reward['points'] }} {{ $config['pbs'] }}) @endif</button>
                @endforeach
            @else
                <div class="alert alert-warning">Vous ne possédez aucune récompense en attente pour ce serveur.</div>
            @endif
        </div>
    @endforeach
</div>

<div class="profile-content">
    <div class="row">
        <div class="col-md-6">
            <h3>Vos paliers en cours</h3>
            @php
            if(isset($vote_pillar_participant)):
                if($vote_pillar_participant->where('userId', $user['id'])->count()):
                    foreach($vote_pillar_participant->where('userId', $user['id'])->get() as $vpp):
                        $vpps = $vote_pillar->where('id', $vpp['pillarId'])->first();
                        if(!$vpp['finish']):
            @endphp
                            <div class="bearing">
                                <span class="bearing-title">{{ $vpps['name'] }}</span>
                                <div class="panel-body">
                                    @if($vote_ranking['vote'] >= $vpps['goal'])
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 100%;">
                                                <span>Objectif atteint !!</span>
                                            </div>
                                        </div>

                                        <form method="POST" action="{{ route('POST_Vote_GetAfter_GetRewardsToVPillar', ['id' => $vpps['id']]) }}">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <button class="btn btn-main">Recevoir ma récompense !</button>
                                        </form>
                                    @else
                                        <div class="progress">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{ $vote_ranking['vote'] }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $vote_ranking['vote'] / $vpps['goal'] * 100 }}%;">
                                                <span>{{ $vote_ranking['vote'] }} / {{ $vpps['goal'] }}</span>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                @php
                            endif;
                    endforeach;
                else:
                @endphp
                    <div class="alert alert-warning">Vous n'avez rejoint aucun palier.</div>
                @php
                endif;
                @endphp
            @endif
        </div>

        <div class="col-md-6">
            <h3>Paliers disponible</h3>

            @if(isset($vote_pillar))
                @php $i=0; @endphp
                @if($vote_pillar->count())
                    @foreach($vote_pillar as $vpillar)
                        @if(!$vote_pillar_participant->where('userId', $user['id'])->where('pillarId', $vpillar['id'])->count())
                            @php $i++; @endphp
                            <div class="bearing-avaible">
                                <span class="bearing-title"> {{ $vpillar['name'] }} <small>(Objectif : {{ $vpillar['goal'] }} votes)</small></span>
                                <div class="panel-body">
                                    <form method="POST" action="{{ route('POST_Vote_GetAfter_RegisterToVPillar', ['id' => $vpillar['id']]) }}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <button class="btn btn-success form-control">Rejoindre !</button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            @endif
            @if($i < 1)
                <div class="alert alert-warning">Aucun palier n'est disponible.</div>
            @endif
        </div>
    </div>
</div>

<script>
    function sendRequest(route) {
        document.querySelector('#fetch-message').innerHTML = '<div class="alert alert-info">Chargement en cours... Veuillez patienter.</div>';
        fetch(route, {
            method: 'post',
            credentials: "same-origin",
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        }).then(function (response) {

            return response.text();

        }).then(function (html) {
            // Success :)
            try {
                let request = JSON.parse(html);
                switch (request.alert) {
                    case 'warning':
                        document.querySelector('#fetch-message').innerHTML = "<div class='alert alert-warning'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" + request.message + "</div>";
                        break;
                    case 'error':
                        document.querySelector('#fetch-message').innerHTML = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" + request.message + "</div>";
                        break;
                    case 'success':
                        document.querySelector('#fetch-message').innerHTML = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" + request.message + "</div>";
                        window.location.reload(1);
                        break;
                    case 'info':
                        document.querySelector('#fetch-message').innerHTML = "<div class='alert alert-info'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" + request.message + "</div>";
                        break;
                }
            } catch (e) {
                document.querySelector('#fetch-message').innerHTML = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>{{ $Lang->choose('INTERNALEERROR') }}</div>";
            }
        }).catch(function (err) {
            // Error :(
            console.log(err);
        });
    }
</script>