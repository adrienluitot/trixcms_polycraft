        </div>

        <div id="footer">
            {{-- <div class="footer-infos row">
                @if(egame()->if('tx_minecraft')->isEnable() && plugin()->if("600967025")->isEnable())
                    <div class="last-voters">
                        <span class="footer-title">Meilleurs voteurs</span>
                        @foreach(tx_model()->instancy("VoteRankings",
                "Extensions\\Plugins\\Mcvote_todyxe__600967025\\App\Models\\")::ranking()->take(3) as $v)
                            <div class="voter-main">
                                <div class="hex-head">
                                    <img src="https://minotar.net/avatar/{{ user($v->user_id)->pseudo }}/42">
                                </div>
                                <div class="voter-infos">
                                    <span class="voter-name">{{  user($v->user_id)->pseudo  }}</span>
                                    <span class="voter-votes">{{ $v->getUserVotes() }} <i class="fas fa-vote-yea"></i></span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
                <div class="socials">
                    <span class="footer-title">Réseaux sociaux</span>
                    <div class="socials-container">
                        @if($perso['twitter-link'] != "false")
                            <a href="<?= $perso['twitter-link']; ?>" target="_blank" class="social twitter"><span class="fab fa-twitter"></span></a>
                        @endif
                        @if($perso['facebook-link'] != "false")
                            <a href="<?= $perso['facebook-link']; ?>" target="_blank" class="social facebook"><span class="fab fa-facebook"></span></a>
                        @endif
                        @if($perso['discord-link'] != "false")
                            <a href="<?= $perso['discord-link']; ?>" target="_blank" class="social discord"><span class="fab fa-discord"></span></a>
                        @endif
                        @if($perso['youtube-link'] != "false")
                            <a href="<?= $perso['youtube-link']; ?>" target="_blank" class="social youtube"><span class="fab fa-youtube"></span></a>
                        @endif
                    </div>
                </div>
            </div> --}}
            <div class="copyright">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-5 copyr">&copy; {{date('Y', time())}} - {{trans('theme::general.all_rights_reserved')}}</div>
                        <div class="col-sm-7 text-right propulse">{!!trans('theme::general.copyright')!!}</div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    <script src="@ThemeAssets('js/mybootstrap.min.js')"></script>
    <script src="@ThemeAssets('js/swiper.min.js')"></script>
    <script src="@ThemeAssets('js/polycraft.js')"></script>
</html>