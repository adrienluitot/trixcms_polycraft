<link href="@ThemeAssets('css/user.css')" rel="stylesheet">

<div class="container login">
    <h2 class="page-title"><span>{{ __('theme_default.Pages.Login.Login') }}</span></h2>

    <div class="content">
        <div id="fetch-message"></div>
        <div class="form w-100 text-left">
            <form method="POST" data-tx-ajax="true" data-tx-ajax-sweetalert="true" data-tx-ajax-redirect="{{ action("Auth\User\ProfileController@home") }}" data-tx-action-uri="{{ action('Auth\User\LoginController@ajax_userLogin') }}">
                <label>{{ __('messages.Form.Pseudo') }}</label>
                <div class="pc-form">
                    <input type="text" name="username" class="form-control" placeholder="{{ __('messages.Form.Pseudo') }}">
                </div>

                <label>{{ __('messages.Form.Password') }}</label>
                <div class="pc-form">
                    <input type="password" name="password" class="form-control" placeholder="{{ __('messages.Form.Password') }}">
                </div>

                <a href="{{ action('Auth\User\RegisterController@userRegister') }}" class="color">{{ __('theme_default.Pages.Login.Register') }}</a>
                <a href="{{ action('Auth\User\ForgotController@userForgot') }}" class="color">{{ __('theme_default.Pages.Login.Forgot') }}</a>

                <button type="submit" name="send" class="btn btn-main d-block mt-3">{{ __('theme_default.Pages.Login.Login') }}</button>
            </form>
        </div>
    </div>
</div>
