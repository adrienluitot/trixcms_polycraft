<link href="@ThemeAssets('css/user.css')" rel="stylesheet">

<div class="container lost-pass">
    <h2 class="page-title"><span>{{ __('theme_default.Pages.Login.Forgot') }}</span></h2>

    <div class="content">
        <div id="fetch-message"></div>
        <div class="form" style="width:100%;text-align:left;">
            <form method="POST" action="{{ route('ajax.cms.forgot.page') }}">
                <label>{{ __('messages.Form.Email') }}</label>
                <div class="pc-form">
                    <input type="email" name="email" class="form-control" placeholder="{{ __('messages.Form.Email') }}">
                </div>

                <button type="submit" class="btn btn-main">{{ __('messages.Form.Submit_Button') }}</button>
            </form>
        </div>
    </div>
</div>
