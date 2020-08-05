<div id="footer">
    <div class="footer-infos row">
        <?php if($tronai->plugin('Vote')): ?>
            <div class="last-voters">
                <span class="footer-title">Meilleurs voteurs</span>
                <?php $voters = $v_rankings->orderByDesc('vote')->take(3)->get(); ?>
                @foreach($voters as $v)
                    <div class="voter-main">
                        <div class="hex-head">
                            <img src="https://minotar.net/avatar/{{ getUserData($v['user_id'], 'pseudo') }}/42">
                        </div>
                        <div class="voter-infos">
                            <span class="voter-name">{{ getUserData($v['user_id'], 'pseudo') }}</span>
                            <span class="voter-votes">{{ $v['vote'] }} <i class="fas fa-vote-yea"></i></span>
                        </div>
                    </div>
                @endforeach
            </div>
        <?php endif; ?>
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
        
    </div>
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-sm-5 copyr">&copy; {{date('Y', time())}} - Tous droits réservés</div>
                <div class="col-sm-7 text-right propulse">Propulsé par <a href="https://trixcms.eu">Trixcms</a> | Thème fait avec <i style="color:tomato;" class="fas fa-heart"></i> par <a href="https://adrien.luitot.fr">Adrien Luitot</a></div>
            </div>
        </div>
    </div>
</div>
