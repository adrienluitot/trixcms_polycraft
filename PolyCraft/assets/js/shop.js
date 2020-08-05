$(document).ready(function () {
    var dontCheckKey = [16,17,18,19,20,33,34,35,36,37,38,39,40,112,113,114,115,116,117,118,119,120,121,144,145];
    $('#promo-code').on('keyup', function (e) {
        if(dontCheckKey.indexOf(e.keyCode) < 0) {
            postFromData($(this).attr('data-url'), {'code_promo': true,'code': this.value});
        }
    });
});

function postFromData(url, data) {
    $('#fetch-message').html('<div class="alert alert-info">Chargement en cours... Veuillez patienter.</div>');
    return fetch(url, {
        method: 'POST',
        headers: new Headers({
            'X-CSRF-TOKEN': TOKEN,
            'Content-type': 'application/x-www-form-urlencoded; charset=UTF-8'
        }),
        body: new URLSearchParams(data),
    }).then(function (response) {
        return response.text().then(function (data) {
            try {
                let request = JSON.parse(data);
                $('#fetch-message').html('<div class="alert alert-'+((request.alert == "error")? "danger":request.alert)+'"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + request.message + '</div>');
            } catch (e) {
                $('#fetch-message').html("<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>Erreur interne, veuillez actualiser la page.</div>");
            }
        });
    });
}

$('.remove-promo').on('click', function () {
    var parent = $(this).parent();
    $.ajax({
        url: $(this).attr('data-url'),
        dataType: 'HTML',
        method: 'post',
        data: '_token='+TOKEN,
        success: function (data) {
            $('#fetch-message').html("<div class='alert alert-success'><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>Promotion supprimé avec succès.</div>");
            var currPrice = parent.find('.new-price').text();
            $('#basket-total').text(parseInt($('#basket-total').text()) - parseInt(currPrice) + parseInt(parent.find('.old-price').text()));
            parent.html(parent.find('.old-price').text() + ' Points');
        }
    });
});

$('#add-to-cart').not('.disabled').on('click', function() {
    $(this).addClass("disabled");
    $(this).text('Ajout au panier...');

    $.ajax({
        url: $(this).attr('data-url'),
        dataType: 'HTML',
        method: 'post',
        data: '_token='+TOKEN + (($('#quantity').length)? '&stock=' + $('#quantity').val() : ''),
        success: function (data) {
            $('#test-return').html(data);
            if(!$('#test-return').find('.basket').length) {
                var modalContent = {
                    title: "Déjà dans la panier",
                    content: "Vous aviez déjà ajouté cet article dans votre panier !"
                };
            } else {
                var modalContent = {
                    title: "Ajouté au panier",
                    content: "L'article à bien été ajouté au panier !"
                };
            }

            $("#test-return").remove();
            $('#added-to-cart .modal-title').text(modalContent.title);
            $('#added-to-cart .modal-body').text(modalContent.content);
            $("#added-to-cart").modal('show');
        }
    });
});