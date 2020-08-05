<link href="@ThemeAssets('css/user.css')" rel="stylesheet">

<div class="container lost-pass">
    <h2 class="page-title"><span>{{ __('theme_default.Pages.Forgot.Verification') }}</span></h2>

    <div class="content">
        <div id="fetch-message"></div>
        <div class="form">
            <form method="POST" data-tx-ajax="true" data-tx-ajax-sweetalert="true" data-tx-ajax-redirect="{{ action("Auth\User\LoginController@userLogin") }}" data-tx-action-uri="{{ action('Auth\User\ForgotController@post_reset_password') }}">
                <input type="hidden" name="data" value="{{ $token }}">

                <label>{{ __('messages.Form.Password') }}</label>
                <div class="pc-form">
                    <input type="password" name="password" class="form-control" placeholder="{{ __('messages.Form.Password') }}">
                </div>

                <label>{{ __('messages.Form.Password') }}</label>
                <div class="pc-form">
                    <input type="password" name="password_repeat" class="form-control" placeholder="{{ __('messages.Form.Password') }}">
                </div>

                <button type="submit" class="btn btn-main">{{ __('messages.Send') }}</button>
            </form>
        </div>
    </div>
</div>
