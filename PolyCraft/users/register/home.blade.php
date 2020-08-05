<?= $todyxe->css('user') ?>

<div class="container register">
    <h2 class="page-title"><span>Inscription</span></h2>

    <div class="content">
        <div id="fetch-message"></div>

        <form method="POST" id="register_form">
            <label>{{ $Lang->choose('FORM-PSEUDO_REGISTER') }}</label>
            <div class="pc-form">
                <input type="text" name="pseudo" class="form-control" placeholder="{{ $Lang->choose('FORM-PSEUDO_REGISTER') }}">
            </div>

            <label>{{ $Lang->choose('FORM-EMAIL_REGISTER') }}</label>
            <div class="pc-form">
                <input type="email" name="email" class="form-control" placeholder="{{ $Lang->choose('FORM-EMAIL_REGISTER') }}">
            </div>

            <label>{{ $Lang->choose('FORM-REMAIL_REGISTER') }}</label>
            <div class="pc-form">
                <input type="email" name="repeatEmail" class="form-control" placeholder="{{ $Lang->choose('FORM-REMAIL_REGISTER') }}">
            </div>

            <label>{{ $Lang->choose('FORM-MDP_REGISTER') }}</label>
            <div class="pc-form">
                <input type="password" name="password" class="form-control" placeholder="{{ $Lang->choose('FORM-MDP_REGISTER') }}">
            </div>

            <label>{{ $Lang->choose('FORM-RMDP_REGISTER') }}</label>
            <div class="pc-form">
                <input type="password" name="repeatPassword" class="form-control" placeholder="{{ $Lang->choose('FORM-RMDP_REGISTER') }}">
            </div>

            @if(!$config['captcha'])
                <label>Captcha</label>
                <div class="pc-form">
                    <input type="text" name="captcha" class="form-control" placeholder="Écrivez le résultat de 5+10" aria-describedby="basic-addon1" style="border-left:none;">
                </div>
            @else
                <div class="g-recaptcha"
                    data-sitekey="{{ $config['publickey'] }}">
                </div>
            @endif

            @if($config['cg'])
                <label id="cgu-check">
                    <input type="checkbox" name="cg">
                    J'ai lu et j'approuve les <a href="<?= $config['linkcg'] ?>" class="color">CGU/CGV</a>
                </label>
            @endif
            
            <button type="submit" name="send" id="send_register" class="btn btn-main">Inscription</button>
        </form>
    </div>
</div>
