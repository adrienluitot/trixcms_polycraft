<?= $todyxe->css('shop') ?>

<div class="container payment">
    @if(request()->get('cancel'))
        <div class="alert alert-danger">Paiement annulé</div>
    @endif
    @if(request()->get('success'))
        <div class="alert alert-success">Paiement validé!</div>
    @endif

    <div class="accordion" id="accordion">
        <div class="accordion-tab" role="tab" id="pay_1">
            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#pay" aria-controls="pay">
                <i class="closed fas fa-chevron-right"></i>
                <i class="opened fas fa-chevron-down"></i>
                PayPal
            </a>
        </div>
        <div id="pay" class="collapse" aria-labelledby="pay_1">
            <div class="accordion-content">
                @if($shop_paypals->count())
                    @foreach($shop_paypals->get() as $paypal)
                        <form method="POST" action="{{ route('POST_Shop_BuyViaPaypal_Offer') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" value="{{ $paypal->id }}">
                            <input type="hidden" name="user_id" value="{{ $user['id'] }}">
                            <button class="w-100  btn btn-main">{{ $paypal->name }}</button>
                        </form>
                    @endforeach
                @else
                    <div class="alert alert-warning m-0 text-center">Aucun paiement n'a encore été ajouté.</div>
                @endif
            </div>
        </div>
        <div class="accordion-tab" role="tab" id="dedi_1">
            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#dedi" aria-controls="dedi_1">
                <i class="closed fas fa-chevron-right"></i>
                <i class="opened fas fa-chevron-down"></i>
                DediPass
            </a>
        </div>
        <div id="dedi" class="collapse" role="tabpanel" aria-labelledby="dedi_1">
            <div class="accordion-content">
                @if($shop_payments->where('type', 'DediPass')->count())
                    @foreach($shop_payments->where('type', 'DediPass')->get() as $payment)
                        <form method="POST" action="{{ route('Shop / Payment / DediPass') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" value="{{ $payment->id }}">
                            <input type="hidden" name="user_id" value="{{ $user['id'] }}">
                            <button class="w-100 btn btn-main">{{ $payment->name }}</button>
                        </form>
                    @endforeach
                @else
                    <div class="alert alert-warning m-0 text-center">Aucun paiement n'a encore été ajouté.</div>
                @endif
            </div>
        </div>
        @if($shop_config['paysafecard'])
            <div class="accordion-tab" role="tab" id="psf_1">
                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#psf" aria-controls="psf">
                    <i class="closed fas fa-chevron-right"></i>
                    <i class="opened fas fa-chevron-down"></i>
                    Paysafecard
                </a>
            </div>
            <div id="psf" class="collapse" role="tabpanel" aria-labelledby="psf_1">
                <div class="accordion-content">
                    <div id="fetch-message-psf"></div>

                    <div class="row">
                        <div class="col-md-4">
                            <input id="montant_psf" type="number" step="any" placeholder="Montant" class="form-control">
                        </div>
                        <div class="col-md-1">
                            <input id="psf_i1" type="text" class="form-control" maxlength="4">
                        </div>
                        <div class="col-md-1">
                            <input id="psf_i2" type="text" class="form-control" maxlength="4">
                        </div>
                        <div class="col-md-1">
                            <input id="psf_i3" type="text" class="form-control" maxlength="4">
                        </div>
                        <div class="col-md-1">
                            <input id="psf_i4" type="text" class="form-control" maxlength="4">
                        </div>
                        <div class="col-md-4">
                            <input type="submit" class="btn btn-main" onclick="postFromData('{{ route('Fetch_Shop_Add_Psf') }}', {montant: document.getElementById('montant_psf').value,first: document.getElementById('psf_i1').value, second: document.getElementById('psf_i2').value, third: document.getElementById('psf_i3').value, four: document.getElementById('psf_i4').value}, 'psf')" class="btn btn-default form-control" style="color:white;" value="Valider">
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<script>
function postFromData(url, data, step) {
    document.querySelector('#fetch-message-' + step).innerHTML = '<div class="alert alert-info">Chargement en cours... Veuillez patienter.</div>';
    return fetch(url, {
        method: 'POST',
        headers: new Headers({
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-type': 'application/x-www-form-urlencoded; charset=UTF-8'
        }),
        body: new URLSearchParams(data),
    }).then(function (response) {
        return response.text().then(function (data) {
            try {
                let request = JSON.parse(data);
                switch (request.alert) {
                    case 'warning':
                        document.querySelector('#fetch-message-' + step).innerHTML = "<div class='alert alert-warning'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" + request.message + "</div>";
                        break;
                    case 'error':
                        document.querySelector('#fetch-message-' + step).innerHTML = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" + request.message + "</div>";
                        break;
                    case 'success':
                        document.querySelector('#fetch-message-' + step).innerHTML = "<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" + request.message + "</div>";
                        break;
                    case 'info':
                        document.querySelector('#fetch-message-' + step).innerHTML = "<div class='alert alert-info'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" + request.message + "</div>";
                        break;
                }
            } catch (e) {
                document.querySelector('#fetch-message-' + step).innerHTML = "<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>Erreur interne, veuillez actualiser la page.</div>";
            }
        });
    });
}
</script>