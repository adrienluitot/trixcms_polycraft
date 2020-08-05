<link href="@ThemeAssets('css/cps.css')" rel="stylesheet">

<div class="container">
    <h2 class="page-title"><span>{{ __('cps_arckene::module.General.title') }}</span></h2>

    <a class="cps-container" id="click-box">
        <span id="clicker-count"></span>
        <span id="cps-text">{{ trans('theme::general.start') }}</span>
        <div id="circle-countdown"></div>
    </a>

    <div class="col-lg-6 offset-lg-3 pc-table-responsive">
        <ul class="pc-table cps-table">
            <li class="body">
                <ul>
                    <li>{{ __('cps_arckene::module.General.clicks') }} : </td>
                    <li class="text-center"><span id="click-count">0</span></li>
                </ul>
                <ul>
                    <li>CPS : </td>
                    <li class="text-center"><span id="cps-count">N/A</span></li>
                </ul>
                <ul>
                    <li>{{ __('cps_arckene::module.General.timer') }} : </td>
                    <li class="text-center"><span id="countdown">0</span>s</li>
                </ul>
            </li>
        </ul>
    </div>
</div>

<script>
    const retry = "{{ __('cps_arckene::module.General.retry') }}";
    const click_here = "{{ __('cps_arckene::module.General.click_here') }}";
    const cps = "{{ __('cps_arckene::module.General.alert') }}";

    let timer = 10;
    let clicks = 0;
    let launched = false;
    let updating;


    $('#click-box').click(function () {
        if (!launched) {
            $('#click-box #cps-text').text(click_here);
            firstClick();
        } else {
            addClick()
        }
    });

    function addClick() {
        clicks++;
        $('#clicker-count').text(clicks)
    }

    function firstClick() {
        launched = !launched;
        updating = setInterval(updateTimer, 10);
        $('#circle-countdown').css({transition: 'all 10400ms linear',width: '100%', height: '100%'});
        addClick();
    }

    function updateTimer() {
        timer -= 0.01;
        if(timer > 0) {
            $('#countdown').html((10-timer).toFixed(2))
        } else {
            stopClicking()
        }
    }

    function stopClicking() {
        launched = !launched;
        clearInterval(updating);
        $('#circle-countdown').css({transition: 'all 0s', width: '0', height: '0'});
        alert(cps + clicks/10 + " CPS");
        $('#click-count').html(clicks);
        $('#cps-count').html(clicks/10);
        timer = 10;
        clicks = 0;
        $('#clicker-count').text("");
        $('#click-box #cps-text').text(retry);
    }
</script>
