<?= $todyxe->css('user') ?>


<div class="container login">
    <h2 class="page-title"><span>Confirmation 2FA</span></h2>

    <div class="content">
        <div id="fetch-message"></div>

        <div class="form" style="width:100%;text-align:left;">
            <form method="POST" id="twofa_authentification">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>{{ $Lang->choose('TWOFASECRETCODE') }}</label>
                        <div class="pc-form">
                            <input type="text" name="secret" id="secret" class="form-control" placeholder="Ex : 154812">
                        </div>
                    </div>

                    @if($code['status'] && $code['lifetime'] > \Carbon\Carbon::now())
                        <div class="form-group col-md-6">
                            <label>{{ $Lang->choose('TWOFACODE') }}</label>
                            <div class="pc-form">
                                <input type="text" class="form-control" value="{{ \Carbon\Carbon::make($code['lifetime'])->diffForHumans() }}" disabled>
                            </div>
                        </div>
                    @else
                        <div class="form-group col-md-6">
                            <label>{{ $Lang->choose('TWOFACODE') }}</label>
                            <div class="pc-form">
                                <input type="text" name="code" id="code" class="form-control" placeholder="Ex : zrdgerZEef4">
                            </div>
                        </div>
                    @endif
                </div>

                <button type="submit" name="send" name="send_2fa_auth" id="send_2fa_auth" class="btn btn-main d-block">{{ $Lang->choose('FORM-SEND_REGISTER') }}</button>
            </form>
        </div>
    </div>
</div>