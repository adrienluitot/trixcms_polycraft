<?= $todyxe->css('user') ?>

<div class="container lost-pass">
    <h2 class="page-title"><span>Mot de passe oublié</span></h2>

      <div class="content">
        <div id="fetch-message"></div>
        <div class="form" style="width:100%;text-align:left;">
            <form method="POST" id="form_forgot">
                <label>{{ $Lang->choose('FORM-EMAIL_REGISTER') }}</label>
                <div class="pc-form">
                    <input type="text" name="email" class="form-control" placeholder="{{ $Lang->choose('FORM-EMAIL_REGISTER') }}">
                </div>
                
                <button type="submit" name="send" id="send_forgot" class="btn btn-main">{{ $Lang->choose('FORM-SEND_REGISTER') }}</button>
            </form>
      </div>
    </div>
</div>
