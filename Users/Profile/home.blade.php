<link href="@ThemeAssets('css/user.css')" rel="stylesheet">

<div class="profile container">
    <h2 class="page-title"><span>{{trans('theme::general.profile')}}</span></h2>

    <div class="profile-content">
        @if(session()->has('success'))
            <div class="alert alert-success">{{ session()->get('success') }}</div>
        @endif

        @if(tx_auth()->hasEnable2Fa())
            <div class="alert alert-info"><i class="fas fa-check"></i> {{ __('theme_default.Pages.Profile.TwoFAIsActivated') }}</div>
        @endif

        @if(site_config('ConfirmEmail') && !user()->hasNotConfirmAccount())
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle"></i>
                {!! __('theme_default.Pages.Profile.ConfirmEmailExclamation', ['email' => user()->email]) !!}
                <hr>
                <form method="POST" action="{{ route('ajax.edit.profile.confirm_email') }}">
                    @csrf
                    <button type="submit" class="btn btn-main">{{ __('theme_default.Pages.Profile.sendMail') }}</button>
                </form>
            </div>
        @endif

        <div class="row">
            <div class="col-md-1">
                <div class="hex-head" style="width: 72px; height: 84px;">
                    <img class='img-profile' src='{{ avatar() }}' style="width: 80px; float: left; margin-right: 35px;" />
                </div>
            </div>
            <div class="col-md-11">
                <label>{{ __('messages.Form.Pseudo') }}</label>
                <div class="pc-form disabled">
                    <input type="text" class="form-control" value="{{ user()->pseudo }}" disabled>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <label>{{ __('messages.Form.Email') }}</label>
                <div class="pc-form disabled">
                    <input type="text" class="form-control" value="{{ user()->email }}" disabled>
                </div>
            </div>
            <div class="col-md-4">
                <label>UUID</label>
                <div class="pc-form disabled">
                    <input type="text" class="form-control" value="{{ user()->uuid }}" disabled>
                </div>
            </div>
            <div class="col-md-4">
                <label>{{ __('messages.Form.Money') }} ({{ site_config('pbs') }})</label>
                <div class="pc-form disabled">
                    <input type="text" class="form-control" value="{{ user()->money }}" disabled>
                </div>
            </div>
            <div class="col-md-8">
                <label>{{ __('messages.Form.Role') }}</label>
                <div class="pc-form disabled">
                    <input type="text" class="form-control" value="{{ user()->getUserRanks() }}" disabled>
                </div>
            </div>
            <div class="col-md-7">
                <label>{{ __('messages.Form.UpdatedAt') }}</label>
                <div class="pc-form disabled">
                    <input type="text" class="form-control" value="{{ user()->updated_at }}" disabled>
                </div>
            </div>
            <div class="col-md-5">
                <label>{{ __('messages.Form.CreatedAt') }}</label>
                <div class="pc-form disabled">
                    <input type="text" class="form-control" value="{{ user()->created_at }}" disabled>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <a data-toggle="collapse" href="#editProfile" role="button" aria-expanded="false" aria-controls="editProfile1" class="btn btn-light w-100"><i class="fas fa-edit"></i> {{ __('theme_default.Pages.Profile.Edit') }}</a>
            </div>
            <div class="col-md-6">
                <a data-toggle="collapse" href="#TwoFA" role="button" aria-expanded="false" aria-controls="TwoFA1" class="btn btn-main w-100"><i class="fas fa-user-shield"></i> {{ __('theme_default.Pages.Profile.2FA') }}</a>
            </div>
        </div>

        <div class="collapse multi-collapse py-3" id="editProfile">
            <div class="col-12">
                <h3>{{ __('theme_default.Pages.Profile.Edit') }}</h3>

                <form method="POST" data-tx-ajax="true" data-tx-ajax-sweetalert="true" data-tx-action-uri="{{ action('Auth\User\ProfileController@ajax_edit_profile') }}">
                    <label>{{ __('theme_default.Pages.Profile.EditEmail') }}</label>
                    <div class="pc-form">
                        <input type="email" name="email" class="form-control" value="{{ user()->email }}">
                    </div>

                    <label>{{ __('theme_default.Pages.Profile.EditPassword') }}</label>
                    <div class="pc-form">
                        <input type="password" name="password" class="form-control" placeholder="************">
                    </div>

                    <button type="submit" class="btn btn-main">{{ __('theme_default.Pages.Profile.EditButton') }}</button>
                </form>

                <form class="mt-4" method="POST" data-tx-ajax="true" data-tx-ajax-sweetalert="true" data-tx-action-uri="{{ action('Auth\User\ProfileController@ajax_send_money') }}">
                    <label>{{ __('theme_default.Pages.Profile.SendMoney', ['money' => site_config('pb')]) }}</label>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="pc-form">
                                <input type="text" name="pseudo" placeholder="Todyxe" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="pc-form">
                                <input step="any" type="number" name="money" placeholder="50.50" class="form-control">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-main">{{ __('messages.Form.Submit_Button') }}</button>
                </form>

                {!! avatar_view() !!}
            </div>
        </div>

        <div class="collapse multi-collapse py-3" id="TwoFA">
            <div class="col-12">
                <h3>{{ __('theme_default.Pages.Profile.2FA') }}</h3>

                <div class="text-center">
                    @if(!tx_auth()->hasEnable2Fa())
                        <img id="twofa_img">

                        <span class="dfa-key" id="twofa_code"></span>

                        <form method="POST" data-tx-ajax="true" data-tx-ajax-sweetalert="true" data-tx-action-uri="{{ action('Auth\User\ProfileController@ajax_active_2fa') }}">
                            <input id="twofa_key_input" type="hidden" name="key" value="">

                            <div class="col-md-6 offset-md-3">
                                <label>{{trans('theme::general.code')}}</label>
                                <div class="pc-form">
                                    <input type="text" name="code" class="form-control" placeholder="{{trans('theme::general.code')}}">
                                </div>

                                <button type="submit" class="btn btn-main">{{ __('messages.Form.Submit_Button') }}</button>
                            </div>
                        </form>
                    @else
                        <form method="POST" action="{{ action('Auth\User\ProfileController@ajax_disable_2fa') }}">
                            @csrf
                            <button type="submit" class="btn btn-main">{{ __('theme_default.Pages.Profile.Disable2fa_Button') }}</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>