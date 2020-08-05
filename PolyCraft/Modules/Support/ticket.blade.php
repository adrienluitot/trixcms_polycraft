<?= $todyxe->css('support') ?>

<div class="container">
    <h2 class="page-title"><span><b>"{{ $its['object'] }}"</b> par {{ getUserData($its['id_user'], 'pseudo') }}</span></h2>

    <div class="ticket-message">
        <span class="message-author">
            <img src="{{ $minecraft->getProfil(getUserData($its['id_user'], 'pseudo')) }}"> {{ getUserData($its['id_user'], 'pseudo') }}
        </span>

        <div class="message-content">
            <p><?= htmlspecialchars_decode(base64_decode($its['message'])) ?></p>
        </div>
    </div>

    @foreach($messages as $message)
        <div class="ticket-message<?= ($message['support'])? ' support-answer':'' ?>">
            <span class="message-author">
                <img src="{{ $minecraft->getProfil(getUserData($message['id_user'], 'pseudo')) }}"> {{ getUserData($message['id_user'], 'pseudo') }}
            </span>
    
            <div class="message-content">
                @if(!$message['support']) <p> @endif
                <?= htmlspecialchars_decode(base64_decode($message['message'])) ?>
                @if(!$message['support']) </p> @endif
            </div>
        </div>
    @endforeach
    
    @if($its['close'])
        <div class="alert alert-warning">Ce ticket est fermé.</div>
    @else
        @if($its['authorization'])
            <div id="fetch-message"></div>

            <form id="form">
                <div class="pc-form textarea">
                    <textarea rows="5" placeholder="Votre réponse..." name="response" class="form-control"></textarea>
                </div>

                <button class="btn btn-main" id="send">Envoyer</button>
            </form>
        @else
            <div class="alert alert-info">
                Vous avez déjà répondu, veuillez attendre la réponse d'un modérateur.
            </div>
        @endif
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelector('#send').addEventListener('click', function (e) {
            document.querySelector('#fetch-message').innerHTML = '<div class="alert alert-info">Chargement en cours... Veuillez patienter.</div>';
            let form = new FormData(document.getElementById('form'));
            form.append('id', {{ $its['id'] }});
            e.preventDefault();
            fetch('{{ route('Fetch_Modules_Support_SendResponse') }}', {
                method: 'post',
                credentials: "same-origin",
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: form
            }).then(function (response) {

                return response.text();

            }).then(function (html) {
                // Success :)
                try {
                    let request = JSON.parse(html);
                    switch (request.alert) {
                        case 'warning':
                            document.querySelector('#fetch-message').innerHTML = "<div class='alert alert-warning'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" + request.message + "</div>";
                            break;
                        case 'error':
                            document.querySelector('#fetch-message').innerHTML = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" + request.message + "</div>";
                            break;
                        case 'success':
                            document.querySelector('#fetch-message').innerHTML = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" + request.message + "</div>";
                            window.location.reload(1);
                            break;
                        case 'info':
                            document.querySelector('#fetch-message').innerHTML = "<div class='alert alert-info'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" + request.message + "</div>";
                            break;
                    }
                } catch (e) {
                    document.querySelector('#fetch-message').innerHTML = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>{{ $Lang->choose('INTERNALEERROR') }}</div>";
                }
            }).catch(function (err) {
                // Error :(
                console.log(err);
            });
        });
    });
</script>
