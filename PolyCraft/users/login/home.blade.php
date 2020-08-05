<?= $todyxe->css('user') ?>

<div class="container login">
    <h2 class="page-title"><span>Connexion</span></h2>
    <div class="content">
        <div id="fetch-message"></div>
        <div class="form" style="width:100%;text-align:left;">
            <form method="POST" id="login_form">
                <label>{{ $Lang->choose('FORM-PSEUDO_REGISTER') }}</label>
                <div class="pc-form">
                    <input type="text" name="pseudo" class="form-control" placeholder="{{ $Lang->choose('FORM-PSEUDO_REGISTER') }}">
                </div>

                <label>{{ $Lang->choose('FORM-MDP_REGISTER') }}</label>
                <div class="pc-form">
                    <input type="password" name="password" class="form-control" placeholder="{{ $Lang->choose('FORM-MDP_REGISTER') }}">
                </div>

                <a href="{{ route('Forgot') }}" class="color">Mot de passe oublié</a>

                <button type="submit" name="send" id="send_login" class="btn btn-main d-block">Connexion</button>
            </form>
        </div>
    </div>
</div>
