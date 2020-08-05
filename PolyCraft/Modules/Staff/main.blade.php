<?= $todyxe->css('staff') ?>

<div class="container">
    <h2 class="page-title"><span>Staff</span></h2>

    <div class="row">
        @foreach($staffs as $staff)
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="staff-box">
                    @php                        
                        $skinSrc = ($minecraft->getProfil($staff->name))? 'http://minotar.net/avatar/'.$staff->name.'/180' : $minecraft->getProfil($staff->name);
                    @endphp
                    <div class="col-10 offset-1 col-md-8 offset-md-2">
                        <div class="hex"><img src="{{ $skinSrc }}"></div>
                    </div>

                    <span class="staff-name">{{$staff->name}}</span>

                    <div class="staff-ranks">
                        @foreach(json_decode($staff->ranks_id) as $id)
                            <span class="staff-rank" style="background-color: #{{$ranks[$id]['color']}};">{{$ranks[$id]['name']}}</span>
                        @endforeach
                    </div>

                    <p class="staff-desc">{{$staff->description}}</p>

                    @if($staff->links != null)
                        <div class="staff-links">
                            @foreach(json_decode($staff->links) as $link)
                                <a href="{{$link[2]}}" target="_blank" style="color: #{{$link[1]}} !important;"><i class="{{$link[0]}}"></i></a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>