const SAVE_USERNAME = $('#save_username');
const SAVE_WEBSITE_ID = $('#save_website');
const TIME_BEFORE_CHECKING_VOTE = 5000; // Per ms

// functions
function jumpToStep(a, b) {
    a["body"].removeClass('show active');
    b["body"].addClass('show active');

    a["alert"].children().removeClass('active');
    b["alert"].children().addClass('active');
}

// Step 1 Check username
$('#step1_form').submit(function(e) {
    e.preventDefault();

    const username_field = $('#username');
    const alert = $('#ajax-message-step1');

    alert.html("<div class='alert alert-info'>" + LOADING_MESSAGE + "</div>");

    return loadByAjax(STEP1_URI_POST, "post", "username=" + username_field.val(), function(response) {
        if(response.alert === "success") {
            SAVE_USERNAME.prop("value", username_field.val());
            return jumpToStep(STEP1, STEP2);
        }

        let alert_response = response.alert === "error" ? "danger" : response.alert;

        return alert.html("<div class='alert alert-" + alert_response + "'>" + response.message + "</div>");
    }, function() {
        return alert.html("<div class='alert alert-danger'>Internal error</div>");
    });
});

// Step2 Choose webadder
function cWebsite(id) {
    loadByAjax(STEP2_URI_CW_POST, "post", "id=" + id, function(response) {
        if(response.custom.response) {
            // STEP2["body"].css('opacity', '0.5').css('cursor', 'not-allowed');

            STEP2["body"].find('.servers').addClass('disabled');

            window.open(response.custom.url, "_blank");

            return websiteChecker(id);
        } else {
            return document.location.reload();
        }
    });
}

function websiteChecker(id) {
    let Interval = setInterval(function () {
        loadByAjax(STEP2_URI_CHECK_POST, "post", "id=" + id, function(response) {
            if(response.response) {
                clearInterval(Interval);

                SAVE_WEBSITE_ID.prop("value", id);
                return jumpToStep(STEP2, STEP3);
            }

            if(!response.response && response.timeout) {
                clearInterval(Interval);

                STEP2["body"].css('opacity', '1').css('cursor', 'all');
                $('#loading_step2').hide();

                return $('#ajax-message-step2').html("<div class='alert alert-warning'>" + response.message + "</div>");
            }
        });
    }, TIME_BEFORE_CHECKING_VOTE);
}

function step3_vote_now() {
    const alert = $('#ajax-message-step3');

    alert.html("<div class='alert alert-info'>" + LOADING_MESSAGE + "</div>");
    STEP3["body"].find('button').remove();

    return loadByAjax(STEP3_URI_NOW_POST, "post", "user=" + SAVE_USERNAME.val() + "&website=" + SAVE_WEBSITE_ID.val(), function(response) {
        let alert_response = response.alert === "error" ? "danger" : response.alert;

        alert.html("<div class='alert alert-" + alert_response + "'>" + response.message + "</div>")

        if(alert_response === "success") {
            setTimeout(function () {
                window.location.reload();
            }, 1000);
        }
    });
}

function step3_vote_after() {
    const alert = $('#ajax-message-step3');

    alert.html("<div class='alert alert-info'>" + LOADING_MESSAGE + "</div>");
    STEP3["body"].find('button').remove();

    return loadByAjax(STEP3_URI_AFTER_POST, "post", "user=" + SAVE_USERNAME.val() + "&website=" + SAVE_WEBSITE_ID.val(), function(response) {
        let alert_response = response.alert === "error" ? "danger" : response.alert;

        alert.html("<div class='alert alert-" + alert_response + "'>" + response.message + "</div>")

        if(alert_response === "success") {
            setTimeout(function () {
                window.location.reload();
            }, 1000);
        }
    });
}