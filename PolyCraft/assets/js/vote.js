let path = document.location.href;
let pathURL = path.substring(0 , path.lastIndexOf("/"));

$('.vote-btn').on('click', function () {
    let pseudo_field = $('#pseudo_step1').val();
    postFormData('/vote/check/pseudo', {pseudo: pseudo_field}, 1).then(function (data) {
        if(data) {
            $('#pseudo-step2').val(pseudo_field);
            $('#vote_1').toggle(300);
            $('#vote_2').toggle(500);
        }
    });
});

$('.vote-website').on('click', function () {
    $('.servers').addClass('disabled');
    let serverId = $(this).attr('data-server-id');
    let websiteId = $(this).attr('data-id');

    let stopCount = new Date().setSeconds(new Date().getSeconds() + 10);
    let countdown = setInterval(function () {
        let remaining = Math.floor(((stopCount - new Date().getTime()) % (1000 * 60)) / 1000);
        $('#the-final-countdown').text(remaining);
        
        if (remaining < 0) {
            $('#the-final-countdown').text(0);
            $(".servers").toggle(300);
            $('#rewards').append('<div id="button_final"><button onclick="step2(\'now\','+websiteId+','+serverId+')" class="btn btn-main">Récupérer maintenant</button> <button onclick="step2(\'after\','+websiteId+','+serverId+')" class="btn btn-light">Récupérer plus tard</button></div>').toggle(500);
            clearInterval(countdown);
        }
    }, 500);
});

function step2(type, site, server) {
    if(type != undefined && site != undefined && server != undefined && (type == 'now' || type == 'after')) {
        let pseudo_field = $('#pseudo-step2').val();
        console.log(pseudo_field);

        postFormData('/vote/check/final/' + type, {pseudo: pseudo_field, site_id: site, server_id: server}, 2).then(function (data) {
            if(data) {
                $('#vote_2').append($('#button_final'));
            }
        });
    }
}

function postFormData(url, data, step) {
    $('#fetch-message-' + step).html('<div class="alert alert-info">Chargement en cours... Veuillez patienter.</div>');
    return fetch(pathURL + url, {
        method: 'POST',
        body: new URLSearchParams(data),
        headers: new Headers({
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Content-type': 'application/x-www-form-urlencoded; charset=UTF-8'
        })
    }).then(function (response) {
        return response.text().then(function (data) {
            try {
                let request = JSON.parse(data);

                $('#fetch-message-' + step).html("<div class='alert alert-"+((request.alert == 'error')? 'danger' : request.alert)+"'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>" + request.message + "</div>");

                if(request.alert == "success" && (url === "/vote/check/final/after" || url === "/vote/check/final/now")) {
                    window.setTimeout(function () {
                        window.location.reload(1);
                    }, 1000);
                }

                return request.authorization;
            } catch (e) {
                $('#fetch-message-' + step).html("<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>Erreur interne, veuillez actualiser la page.</div>");
                return request.authorization;
            }
        });
    });
}