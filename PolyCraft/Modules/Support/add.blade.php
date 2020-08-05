
<div class="container">
    <h2 class="page-title"><span>Créer un ticket</span></h2>

    <div id="fetch-message"></div>

    <form class="form" id="form">
        <label>Titre</label>
        <div class="pc-form">
            <input type="text" class="form-control" name="object" placeholder="Mon problème">
        </div>

        <label>Catégorie</label>
        <div class="pc-form select">
            <input name="categorie" type="hidden" value="{{$s_categorie[0]['id']}}">
            <div name="categorie" class="fake-select">
                <div class="options-container">
                    <div class="fake-option selected"><span>{{$s_categorie[0]['name']}}</span></div>

                    @php $i=0; @endphp
                    @foreach($s_categorie as $s)
                        <div class="fake-option<?= ($i==0)? ' active': '' ?>" data-value="{{ $s['id'] }}">
                            <span>{{ $s['name'] }}</span>
                        </div>
                        @php $i++; @endphp
                    @endforeach
                </div>
                <i class="fas fa-chevron-down"></i>
            </div>
        </div>

        <div class="pc-form textarea">
            <textarea name="message" class="form-control" rows="5" placeholder="Description de mon problème...."></textarea>
        </div>
        
        <button id="send" class="btn btn-main mt-2">Envoyer</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelector('#send').addEventListener('click', function (e) {
        document.querySelector('#fetch-message').innerHTML = '<div class="alert alert-info">Chargement en cours... Veuillez patienter.</div>';
        e.preventDefault();
        fetch('{{ route('Fetch_Modules_Support_CreateNew_Ticket') }}', {
            method: 'post',
            credentials: "same-origin",
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: new FormData(document.getElementById('form'))
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
                        window.location.href = "{{ route('Support / Home') }}";
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
