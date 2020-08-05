<div class="col-12">
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-general-tab" data-toggle="tab" href="#nav-general" role="tab" aria-controls="nav-general" aria-selected="true">{{trans("theme::general.all_pages")}}</a>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active p-2" id="nav-general" role="tabpanel" aria-labelledby="nav-home-tab">
            <h2>{{trans("theme::general.all_pages")}}</h2>
            <div class="col-12">
                <h4>{{trans("theme::general.header")}}</h4>
                <div class="col-12">
                    <div class="form-group">
                        <label>{{trans("theme::general.website_logo")}}</label>
                        <input type="text" name="website_logo" placeholder="{{trans("theme::general.website_logo")}}" value="{{ theme()->config('website_logo') }}" class="form-control">
                    </div>
                </div>

                <h4>{{trans("theme::general.slider")}}</h4>
                <div class="col-12">
                    <div class="form-group">
                        <label>{{trans("theme::general.slider")}}</label>
                        <input type="text" name="slider_url" placeholder="{{trans("theme::general.slider_url")}}" value="{{ theme()->config('slider_url') }}" class="form-control">
                    </div>
                </div>

                <h4>{{trans("theme::general.splashart")}}</h4>
                <div class="col-12">
                    <div class="form-group">
                        <label>{{trans("theme::general.all_pages_splashart_url")}}</label>
                        <input type="text" name="all_pages_splashart_url" placeholder="{{trans("theme::general.all_pages_splashart_url")}}" value="{{ theme()->config('all_pages_splashart_url') }}" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('input[type=checkbox]').on('change', function () {
        $('input[name='+$(this).data('target-input')+']').val($(this).prop('checked'));
    });
</script>