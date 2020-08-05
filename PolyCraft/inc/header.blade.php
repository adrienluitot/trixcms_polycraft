<div id="header">
    <nav class="navbar navbar-expand-lg fixed-top">
        <a class="navbar-brand" href="/">
            <img src="{{ $perso['logo'] }}" class="d-inline-block align-top" alt="">
        </a>
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav main-links ml-auto mr-auto">
                @if(count($navbar))
                    @foreach($navbar as $n)
                        @if($n->parent_id == null && !funcView()->access('NavbarZ', 'App')->where('parent_id', $n->id)->count())
                            <li class="nav-item<?= (substr($n->link, 1) == explode('/', $_SERVER['REQUEST_URI'])[1])? ' active':''; ?>">
                                <a class="nav-link" href="{{ url()->to($n->link) }}">{{ $n->name }}</a>
                            </li>
                        @else
                            @if($n->parent_id == null)
                                <li class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= $n->name  ?><span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                            @endif
                            @php
                                $decode_menu = funcView()->access('NavbarZ', 'App')->where('parent_id', $n->id)->orderBy('position')->get();
                            @endphp
                            @foreach($decode_menu as $menu)
                                <li><a href="{{ url()->to($menu['link']) }}"><span>{{ $menu['name'] }}</span></a></li>
                            @endforeach
                            @if($n->parent_id == null)
                                    </ul>
                                </li>
                            @endif
                        @endif
                    @endforeach
                @endif
          </ul>

          <ul class="navbar-nav account-zone">
              <?php if($isLogin): ?>
                  <li class="nav-item"><a class="nav-link" href="{{ $todyxe->redirect('Profil') }}"><img src="{{ $minecraft->getProfil($user['pseudo']) }}" style="height: 20px;border-radius:50%;"> <span class="d-inline-block d-lg-none">Profil</span></a></li>

                  <li class="nav-item">
                        <a class="nav-link notif-link" href="#" data-toggle="modal" data-target="#notificationsModal">
                            <i class="fas fa-bell d-none d-lg-inline"></i><span class="d-block d-lg-none">Notifications</span>
                            @if($lnotifs->count())
                            <span class="notification-count">{{ $lnotifs->count() }}</span>
                            @endif
                        </a>
                  </li>

                  <?php if($isAdmin): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ $todyxe->redirect('DashBoard') }}"><i class="fas fa-cogs"></i> <span class="d-inline-block d-lg-none">Admin</span></a>
                        </li>
                  <?php endif; ?>

                  <li class="nav-item">
                      <a class="nav-link" href="{{ $todyxe->redirect('Logout') }}"><i class="fas fa-power-off d-none d-lg-inline"></i><span class="d-block d-lg-none">Déconnexion</span></a>                       
                  </li>
              <?php else: ?>
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-user"></i>
                      </a>
                      <div class="dropdown-menu connection-dropdown" aria-labelledby="navbarDropdownMenuLink">
                          <a class="dropdown-item" href="{{ $todyxe->redirect('Login') }}"><span>Connexion</span></a>
                          <a class="dropdown-item" href="{{ $todyxe->redirect('Register') }}"><span>Inscription</span></a>
                      </div>
                  </li>
              <?php endif; ?>
          </ul>
      </div>
  </nav>
</div>
