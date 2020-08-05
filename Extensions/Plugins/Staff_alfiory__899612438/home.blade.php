<link href="@ThemeAssets('css/staff.css')" rel="stylesheet">

<div class="container">
    <h2 class="page-title"><span>{{trans('theme::general.staff')}}</span></h2>

    <div class="row">
        @foreach($staffMembers as $member)
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="staff-box">
                    <div class="col-10 offset-1 col-md-8 offset-md-2">
                        @if(egame()->if("tx_minecraft")->isEnable())
                            @if(empty($member->image_url))
                                <div class="hex"><img src="https://minotar.net/avatar/{{$member->name}}" alt="{{$member->name}}"></div>
                            @else
                                <img class="img-fluid" src="{{$member->image_url}}" alt="{{$member->name}}">
                            @endif
                        @elseif(!empty($member->image_url))
                            <img class="img-fluid" src="{{$member->image_url}}" alt="{{$member->name}}">
                        @endif
                    </div>

                    <span class="staff-name">{{$member->name}}</span>

                    @if(!empty($member->ranks_id))
                        <div class="staff-ranks">
                            @foreach(json_decode($member->ranks_id, true) as $rankId)
                                @if(isset($ranks[$rankId]))
                                    <span class="staff-rank" style="background: #{{$ranks[$rankId]['color']}};">{{$ranks[$rankId]['name']}}</span>
                                @endif
                            @endforeach
                        </div>
                    @endif

                    <p class="staff-desc">{!!nl2br($member->description)!!}</p>

                    @if(!empty($member->links))
                        <div class="staff-links">
                            @foreach(json_decode($member->links, true) as $link)
                                <a href="{{$link[0]}}" target="_blank" style="color: #{{$link[2]}};"><i class="{{$link[1]}}"></i></a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>