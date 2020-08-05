<div class="modal fade" id="notificationsModal" tabindex="-1" role="dialog" aria-labelledby="notificationsModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title" id="myModalLabel">{{ $Lang->choose('PARAMNOTIF') }}</span>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>

            <div class="modal-body">
                <div id="fetch-message-notifreadall"></div>
                <div id="notification_body">
                    @if($lnotifs->count())
                        @foreach($lnotifs as $lnotif)
                            <div class="notif">
                                <span class="notif-title">{{ $lnotif['objet'] }}</span>
                                <p>{{ htmlspecialchars_decode(base64_decode($lnotif['contain'])) }}</p>
                                <span class="notif-time">{{ editDateBy($lnotif['created_at']) }}</span>
                            </div>
                        @endforeach
                    @else
                        <div class="alert alert-warning">{{ $Lang->choose('ANYNOTIFS') }}</div>
                    @endif
                </div>
                
                <hr>
                
                <div class="collapse" id="openparamnotifs">
                    <div class="notif-params">
                        <span class="modal-title">{{ $Lang->choose('NOTIFSSETTINGS') }}</span>

                        <div id="fetch-message-param"></div>

                        <form method="POST" id="form_notifications_settings">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Nombre de notification max affichées</label>

                                    <div class="pc-form">
                                        <input type="number" placeholder="20 par défaut" name="nbr" id="nbr" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>{{ $Lang->choose('NOTIFPARAMMAIL') }}</label>
                                    <div class="pc-form select">
                                        <input name="mail" type="hidden" value="{{ $showMail[1] }}">

                                        <div name="categorie" class="fake-select">
                                            <div class="options-container">
                                                <div class="fake-option selected"><span>{{ $showMail[0] }}</span></div>

                                                <div class="fake-option{{ (!$showMail[1])? ' active':'' }}" data-value="0">
                                                    <span>{{ $Lang->choose('NO_NEWS_ADMINCONTROLLER') }}</span>
                                                </div>
                                                <div class="fake-option{{ ($showMail[1])? ' active':'' }}" data-value="1">
                                                    <span>{{ $Lang->choose('YES_NEWS_ADMINCONTROLLER') }}</span>
                                                </div>
                                            </div>
                                            <i class="fas fa-chevron-down"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <input type="submit" name="send_notification_param" id="send_notification_param" class="btn btn-main">
                        </form>
                    </div>
                </div>

                <div class="notif-footer">
                    <button type="button" class="btn btn-main" data-toggle="collapse" data-target="#openparamnotifs" aria-expanded="false" aria-controls="openparamnotifs">{{ $Lang->choose('NOTIFSSETTINGS') }}</button>
                    
                    <button type="button" id="notification_read_all" name="notification_read_all" class="btn btn-main">{{ $Lang->choose('NOTIFREADALL') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
