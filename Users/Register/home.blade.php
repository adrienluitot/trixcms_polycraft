<link href="@ThemeAssets('css/user.css')" rel="stylesheet">

<div class="container register">
    <h2 class="page-title"><span>{{ __('theme::general.register') }}</span></h2>

    <div class="content">
        <div id="fetch-message"></div>

        <form method="POST" data-tx-ajax="true" data-tx-ajax-afterexecute="try {grecaptcha.reset()} catch(e) { console.log('No Recaptcha') }" data-tx-ajax-sweetalert="true" data-tx-ajax-redirect="{{ action("Auth\User\ProfileController@home") }}" data-tx-action-uri="{{ action('Auth\User\RegisterController@ajax_userRegister') }}">
            <label>{{ __('messages.Form.Pseudo') }}</label>
            <div class="pc-form">
                <input type="text" name="username" class="form-control" placeholder="{{ __('messages.Form.Pseudo') }}">
            </div>

            <label>{{ __('messages.Form.Email') }}</label>
            <div class="pc-form">
                <input type="email" name="email" class="form-control" placeholder="{{ __('messages.Form.Email') }}">
            </div>

            <label>{{ __('messages.Form.Password') }}</label>
            <div class="pc-form">
                <input type="password" name="password" class="form-control" placeholder="{{ __('messages.Form.Password') }}">
            </div>

            <label>{{ __('messages.Form.Password') }}</label>
            <div class="pc-form">
                <input type="password" name="rpassword" class="form-control" placeholder="{{ __('messages.Form.Password') }}">
            </div>

            @if(site_config('captcha'))
                <div class="form-group">
                    {!! NoCaptcha::display(['data-theme' => 'dark']) !!}
                </div>
            @endif

            @if(site_config('cg'))
                <label id="cgu-check">
                    <input type="checkbox" name="conditions">
                    {!! __("theme_default.Pages.Register.Conditions", ["uri" => "<a target='_blank' href='" . site_config('linkcg') . "'>conditions.</a>"]) !!}
                </label>
            @endif

            <a href="{{ action('Auth\User\LoginController@userLogin') }}" class="d-block mb-3">{{ __('theme_default.Pages.Register.Login') }}</a>

            <button type="submit" class="btn btn-main">{{ __('theme::general.register') }}</button>
        </form>
    </div>
</div>
