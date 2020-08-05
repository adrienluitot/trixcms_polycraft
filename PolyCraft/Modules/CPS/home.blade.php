<?= $todyxe->css('cps') ?>


<div class="container">
    <h2 class="page-title"><span>CPS</span></h2>

    <a class="cps-container" id="countcps">
        <span id="clicker-count"></span>
        <span id="cps-text">COMMENCER</span>
        <div id="circle-countdown"></div>
    </a>

    <div class="col-lg-6 offset-lg-3 pc-table-responsive">
        <ul class="pc-table cps-table">
            <li class="body">
                <ul>
                    <li>Nombre de clique : </td>
                    <li class="text-center"><span id="click-count">0</span></li>
                </ul>
                <ul>
                    <li>Cliques par seconde : </td>
                    <li class="text-center"><span id="cps-count">N/A</span></li>
                </ul>
                <ul>
                    <li>Temps restant : </td>
                    <li class="text-center"><span id="countdown">0</span>s</li>
                </ul>
            </li>
        </ul>
    </div>
</div>

<script>
    let clicks = 0;
    let timer = 10;
    let x;
    let begin = false;

    $('.cps-container').on('click', function () {
        if (!begin) {
            startTimer();
        } else {
            addClick();
        }
    });

    function addClick()
    {
        clicks++;
        $('#click-count, #clicker-count').text(clicks)
    }

    function startTimer() {
        begin = true;
        x = setInterval(updateTimer, 1000);
        $('#cps-text').html('CLIQUEZ');
        $('#circle-countdown').css({transition: 'all 10s linear',width: '100%', height: '100%'});
        $('#countdown').text(10);
        $('#click-count, #clicker-count').text(0);
    }

    function stopTimer() {
        begin = false;
        clearInterval(x);
        $('#countdown').text(0);
        $('#circle-countdown').css({transition: 'all 0s', width: '0', height: '0'});
        $('#cps-text').html('RECOMMENCER');

        $('#cps-count').text((clicks/10))
        alert('Vous avez fait en moyenne ' + (clicks/10) + ' cliques par seconde.')

        timer = 10;
        clicks = 0;
    }

    function updateTimer() {
        timer--;
        if (timer > 0) {
            $('#countdown').text(timer)
        } else {
            stopTimer()
        }
    }
</script>