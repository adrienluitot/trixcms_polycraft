<?= $todyxe->css('user') ?>


<div class="profile container">
    <h2 class="page-title"><span>{{ $user['pseudo'] }}</span></h2>

    <div class="profile-content">
        @if(!$user['confirm_email'])
            <div class="alert alert-danger">
              Vous devez confirmer votre compte par email !
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <h3>Vos Informations</h3>
            </div>

            <div class="col-md-6">
                <label>ID</label>
                <div class="pc-form disabled">
                    <input type="text" placeholder="{{ $user['id'] }}" class="form-control" disabled>
                </div>
            </div>
            <div class="col-md-6">
                <label>{{ $Lang->choose('FORM-PSEUDO_REGISTER') }}</label>
                <div class="pc-form disabled">
                    <input type="text" placeholder="{{ $user['pseudo'] }}" class="form-control" disabled>
                </div>
            </div>
            <div class="col-md-6">
                <label>{{ $Lang->choose('FORM-EMAIL_REGISTER') }}</label>
                <div class="pc-form disabled">
                    <input type="text" placeholder="{{ $user['email'] }}" class="form-control" disabled>
                </div>
            </div>
            <div class="col-md-6">
                <label>{{ $Lang->choose('GRADE_PROFIL') }}</label>
                <div class="pc-form disabled">
                    <input type="text" placeholder="{{ $user['grade'] }}" class="form-control" disabled>
                </div>
            </div>
            <div class="col-md-6">
                <label>Money</label>
                <div class="pc-form disabled">
                    <input type="text" placeholder="{{ $user['money'] }}" class="form-control" disabled>
                </div>
            </div>
            <div class="col-md-6">
                <label>{{ $Lang->choose('ETAT_PROFIL') }}</label>
                <div class="pc-form disabled">
                    <input type="text" placeholder="{{ $user['banned'] }}" class="form-control" disabled>
                </div>
            </div>
            <div class="col-md-6">
                <label>{{ $Lang->choose('CREATED_AT_PROFIL') }}</label>
                <div class="pc-form disabled">
                    <input type="text" placeholder="{{ $user['date'] }}" class="form-control" disabled>
                </div>
            </div>
            <div class="col-md-6">
                <label>{{ $Lang->choose('UPDATED_AT_PROFIL') }}</label>
                <div class="pc-form disabled">
                    <input type="text" placeholder="{{ $user['maj'] }}" class="form-control" disabled>
                </div>
            </div>
        </div>
    </div>

    @if($config['pb_status'])
        <div class="profile-content">
            <div class="row">
                <div class="col-12">
                    <div id="fetch-message_form_profil_information_money"></div>
                    <h3>Envoyer de l'argent</h3>
                </div>
            
                <div class="col-md-6">
                    <label>Pseudo</label>
                    <div class="pc-form">
                        <input type="text" id="pseudo" placeholder="Pseudo" class="form-control" autocomplete="off">
                    </div>
                </div>

                <div class="col-md-6">
                    <label>Montant</label>
                    <div class="pc-form">
                        <input type="number" id="money" placeholder="Montant" class="form-control" autocomplete="off">
                    </div>
                </div>

                <div class="col-12">
                    <button type="submit" id="send_profil_information_money" class="btn btn-main">{{ $Lang->choose('FORM-SEND_REGISTER') }}</button>
                </div>
            </div>
        </div>
    @endif

    <div class="profile-content">
        <div class="row">
            <div class="col-12">
                <div id="fetch-message_form_profil_information"></div>
                <h3>Modifier vos informations</h3>
            </div>
        </div>

        <form method="POST" id="form_profil_information">
            <div class="row">
                @if($config['editPseudo'])
                    @if($user['UserEditPseudo'])
                        <div class="col-md-6">
                            <label>Pseudo</label>
                            <div class="pc-form m-0">
                                <input type="text" id="edit_pseudo" name="edit_pseudo" placeholder="{{ $user['pseudo'] }}" class="form-control" autocomplete="off">
                            </div>
                            <small>Attention: Vous ne pourrez re modifier votre pseudo qu'après {{ $config['nbrEditPseudo'] }} mois d'attente.</small>
                        </div>
                    @else
                        <div class="col-md-6">
                            <label>Pseudo</label>
                            <div class="pc-form disabled m-0">
                                <input type="text" id="edit_pseudo" name="edit_pseudo" placeholder="{{ $user['pseudo'] }}" class="form-control" disabled>
                            </div>
                            <small>Vous avez dejà modifier votre pseudo il y a moins d'un mois.</small>
                        </div>
                    @endif
                @endif
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <label>{{ $Lang->choose('FORM-EMAIL_REGISTER') }}</label>
                    <div class="pc-form">
                        <input type="email" name="email" placeholder="{{ $user['email'] }}" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <label>{{ $Lang->choose('FORM-REMAIL_REGISTER') }}</label>
                    <div class="pc-form">
                        <input type="email" name="repeatemail" placeholder="{{ $user['email'] }}" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <label>{{ $Lang->choose('FORM-MDP_REGISTER') }}</label>
                    <div class="pc-form">
                        <input type="password" name="password" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <label>{{ $Lang->choose('FORM-RMDP_REGISTER') }}</label>
                    <div class="pc-form">
                        <input type="password" name="repeatpassword" class="form-control">
                    </div>
                </div>

                <div class="col-md-12">
                    <input type="submit" id="send_profil_information" class="btn btn-main" value="{{ $Lang->choose('FORM-SEND_REGISTER') }}">
                </div>
            </div>
        </form>
    </div>

    <div class="profile-content">
        <div class="row">
            <div class="col-12">
                <h3>Modifer votre apparence sur le site</h3>
            </div>
    
            <div class="col-md-6">
                <div id="fetch-message-skin"></div>
                
                <form method="POST" id="form_profil_skin" enctype="multipart/form-data">
                    <label>Skin</label>
                    <div class="pc-form file-input">
                        <label for="skin_import">Sélectionnez un fichier</label>
                        <input id="skin_import" name="skin_import" type="file">
                    </div>
                    
                    <input type="submit" id="send_profil_skin" class="btn btn-main" value="Modifier">
                </form>
            </div>
    
            <div class="col-md-6">
                <div id="fetch-message-cape"></div>
                
                <form method="POST" id="form_profil_cape" enctype="multipart/form-data">
                    <label>Cape</label>
                    <div class="pc-form file-input">
                        <label for="skin_import">Sélectionnez un fichier</label>
                        <input id="cape_import" name="cape_import" type="file">
                    </div>
                    
                    <input type="submit" id="send_profil_cape" class="btn btn-main" value="Modifier">
                </form>
            </div>
        </div>
    </div>
    
  <div class="profile-content">
        <div class="row">
            <div class="col-12">
                <h3>Authentification à 2 facteurs</h3>
            </div>

            <div class="col-md-6 offset-md-3 text-center">
                <div id="fetch-message-2fa"></div>

                @if(!$user['gauth'])
                    <button id="Twofa_activate" class="btn btn-main">{{ $Lang->choose('BUTTON_2FAACTIVE') }}</button>
                @else
                    <img src="{{ $TwoFA_img }}">
                    <span class="dfa-key">{{ $key }}</span>

                    <form method="POST" id="form_send_data_2fa_activate">
                        <label>{{ $Lang->choose('TWOFALABELFORCODE') }}</label>

                        <div class="pc-form">
                            <input type="text" name="code" id="code" class="form-control" placeholder="Ex : 514684566822456">
                        </div>

                        <input type="submit" id="Twofa_send_code" class="btn btn-main mb-3" value="Valider">
                    </form>

                    <button id="Twofa_desactivate" class="btn btn-main">{{ $Lang->choose('BUTTON_2FADESACTIVE') }}</button>
                @endif
            </div>
        </div>
  </div>

  <?= $tronai->loadModuleView() ?>
</div>
