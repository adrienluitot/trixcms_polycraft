<form id="form-perso">
  <div id="fetch-message"></div>

  <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
      <li class="nav-item">
          <a class="nav-link active" id="1-tab" data-toggle="tab" href="#t1" role="tab" aria-controls="home" aria-selected="true">Général</a>
      </li>
  </ul>
  <br><br>
  <div class="tab-content container">
      <div class="tab-pane fade show active" id="t1" role="tabpanel" aria-labelledby="home-tab">
          <label>Logo du serveur</label>
          <input type="text" name="logo" class="form-control" value="<?= $perso['logo'] ?>">
          <br>
          <label>Image de fond pour les pages</label>
          <input type="text" name="background-image" class="form-control" value="<?= $perso['background-image'] ?>">
          <br><br>

          <label>Image de fond pour les catégories de la boutique</label>
          <input type="text" name="shop-cats-background" class="form-control" value="<?= $perso['shop-cats-background'] ?>">
          <br>
          <label>Texte pour l'objectif de la boutique</label>
          <input type="text" name="shop-goal-text" class="form-control" value="<?= $perso['shop-goal-text'] ?>">
          <small>Mettre "false" pour ne rien afficher</small>
          <br><br>

          <label>Lien pour Twitter</label>
          <input type="text" name="twitter-link" class="form-control" value="<?= $perso['twitter-link'] ?>">
          <small>Mettre "false" pour ne rien afficher</small>
          <br><br>
          <label>Lien pour Facebook</label>
          <input type="text" name="facebook-link" class="form-control" value="<?= $perso['facebook-link'] ?>">
          <small>Mettre "false" pour ne rien afficher</small>
          <br><br>
          <label>Lien pour Youtube</label>
          <input type="text" name="youtube-link" class="form-control" value="<?= $perso['youtube-link'] ?>">
          <small>Mettre "false" pour ne rien afficher</small>
          <br><br>
          <label>Lien pour Discord</label>
          <input type="text" name="discord-link" class="form-control" value="<?= $perso['discord-link'] ?>">
          <small>Mettre "false" pour ne rien afficher</small>
      </div>
  </div>

  <input type="submit" id="send_request" value="Sauvegarder" class="btn btn-success">
</form>
