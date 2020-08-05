<?= $todyxe->css('support') ?>

<div class="container">
    <h2 class="page-title"><span>Support</span></h2>
    
    <a href="{{ route('Support / Add') }}" class="btn btn-main btn-block mb-3" style="widli:100%;">Créer un ticket</a>
    
    <div class="support-table pc-table-responsive">
        <ul class="pc-table">
            <li class="head">
                <ul>
                    <li class="sup-object">Objet</li><!--
                    --><li class="sup-cat">Catégorie</li><!--
                    --><li class="sup-state">Status</li><!--
                    --><li class="sup-upd">Dernière mise à jour</li><!--
                    --><li class="sup-create">Date de création</li><!--
                    --><li class="sup-action">Action</li>
                </ul>
            </li>
            <li class="body">
                @if($supports->count())
                    @foreach($supports as $support)
                        <ul>
                            <li class="sup-object">{{ $support['object'] }}</li><!--
                            --><li class="sup-cat">{{ $s_categorie->where('id', $support['id_categorie'])->first()['name'] }}</li><!--
                            --><li class="sup-state">
                                @if(!$support['close'])
                                    @if($support['status'] == 1)
                                        En attente de réponse d'un staff
                                    @else
                                        En attente de votre réponse
                                    @endif
                                @else
                                    Fermé
                                @endif
                            </li><!--
                            --><li class="sup-upd">@if($support['updated_at'] != null) {{ \Carbon\Carbon::make($support['updated_at'])->diffForHumans() }} @else Aucune mise à jour @endif</li><!--
                            --><li class="sup-create">{{ \Carbon\Carbon::make($support['created_at'])->diffForHumans() }}</li><!--
                            --><li class="sup-action">
                            <a href="{{ \Illuminate\Support\Facades\Redirect::route('Support / Ticket', ['id' => $support['id']])->getTargetUrl() }}">Voir</a>
                            </li>
                        </ul>
                    @endforeach
                @else
                    <ul>
                        <li class="sup-object">Aucune donnée</li>
                        <li class="sup-cat">Aucune donnée</li>
                        <li class="sup-state">Aucune donnée</li>
                        <li class="sup-upd">Aucune donnée</li>
                        <li class="sup-create">Aucune donnée</li>
                        <li class="sup-action">Aucune donnée</li>
                    </ul>
                @endif
            </li>
        </ul>
    </div>
</div>
