<link href="@ThemeAssets('css/user.css')" rel="stylesheet">

<div class="container login">
    <h2 class="page-title"><span>{{ __('theme_default.Pages.TwoFA.Title') }}</span></h2>

    <div class="content">
        <div id="fetch-message"></div>

        <div class="form" style="width:100%;text-align:left;">
            <form method="POST" data-tx-ajax="true" data-tx-ajax-redirect="{{ action("Auth\User\ProfileController@home") }}" data-tx-ajax-sweetalert="true" data-tx-action-uri="{{ action('Auth\User\VerificationController@ajax_double_auth_setup') }}">
                <label>{{trans('theme::general.code')}}</label>
                <div class="pc-form">
                    <input type="text" name="code" class="form-control" placeholder="{{trans('theme::general.code')}}">
                </div>

                <button type="submit" class="btn btn-main d-block">{{ __('messages.Form.Submit_Button') }}</button>
            </form>
        </div>
    </div>
</div>