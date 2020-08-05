<link href="@ThemeAssets('css/support.css')" rel="stylesheet">

<div class="container">
    <h2 class="page-title"><span>{{ trans('theme::general.support') }}</span></h2>

    <div class="col-12">
        @if(session('support_flash'))
            <div class="alert alert-{{session('support_flash')['state']}}">
                {{session('support_flash')['message']}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <h3>{{trans('support_alfiory::user.opened_tickets')}}</h2>
        <div class="support-table pc-table-responsive">
            <ul class="pc-table">
                <li class="head">
                    <ul>
                        <li class="sup-cat">{{trans('support_alfiory::user.category')}}</li><!--
                        --><li class="sup-object">{{trans('support_alfiory::user.subject')}}</li><!--
                        --><li class="sup-create">{{trans('support_alfiory::user.creation_date')}}</li><!--
                        --><li class="sup-state">{{trans('support_alfiory::user.read')}}</li><!--
                        --><li class="sup-action">{{trans('support_alfiory::user.manage')}}</li>
                    </ul>
                </li>
                <li class="body">
                    @foreach($openedTickets as $ticket)
                        <ul{!! (!isset($ticket->seen) || $ticket->seen)? ' class="read"':'' !!}>
                            <li class="sup-cat">{{$ticket->category_name}}</li><!--
                            --><li class="sup-object">{{$ticket->subject}}</li><!--
                            --><li class="sup-create">{{ \Carbon\Carbon::parse($ticket->created_at)->locale(app()->getLocale())->isoFormat('LLL') }}</li><!--
                            --><li class="sup-state">{!! (!isset($ticket->seen) || $ticket->seen)? trans('support_alfiory::admin.read') . ' <i class="fas fa-low-vision"></i>' : trans('support_alfiory::admin.unread') . ' <i class="far fa-eye"></i>' !!}</li><!--
                            --><li class="sup-action">
                                <a href="{{route('support_alfiory.ticket', ['id' => $ticket->id])}}"><i class="fas fa-external-link-square-alt"></i></a>
                                <a class="resolve-ticket" data-ticket-id="{{$ticket->id}}" title="{{trans('support_alfiory::user.resolve_ticket')}}"><i class="fas fa-thumbs-up"></i></a>
                            </li>
                        </ul>
                    @endforeach
                    @if(!sizeof($openedTickets))
                        <ul>
                            <li style="text-align: center;font-style: italic; width: 100%;">{{trans("support_alfiory::user.no_opened_ticket")}}</li>
                        </ul>
                    @endif
                </li>
            </ul>
        </div>

        <a href="{{route('support_alfiory.new_ticket')}}" class="btn btn-main btn-block mb-3">{{trans('support_alfiory::user.open_new_ticket')}}</a>

        <h3 class="mt-5">{{trans('support_alfiory::user.resolved_tickets')}}</h2>
        <div class="support-table support-table-closed pc-table-responsive">
            <ul class="pc-table">
                <li class="head">
                    <ul>
                        <li class="sup-cat">{{trans('support_alfiory::user.category')}}</li><!--
                        --><li class="sup-object">{{trans('support_alfiory::user.subject')}}</li><!--
                        --><li class="sup-create">{{trans('support_alfiory::user.creation_date')}}</li><!--
                        --><li class="sup-action">{{trans('support_alfiory::user.display')}}</li>
                    </ul>
                </li>
                <li class="body">
                    @foreach($closedTickets as $ticket)
                        <ul{!! (!isset($ticket->seen) || $ticket->seen)? ' class="read"':'' !!}>
                            <li class="sup-cat">{{$ticket->category_name}}</li><!--
                            --><li class="sup-object">{{$ticket->subject}}</li><!--
                            --><li class="sup-create">{{ \Carbon\Carbon::parse($ticket->created_at)->locale(app()->getLocale())->isoFormat('LLL') }}</li><!--
                            --><li class="sup-action">
                                <a href="{{route('support_alfiory.ticket', ['id' => $ticket->id])}}"><i class="fas fa-external-link-square-alt"></i></a>
                            </li>
                        </ul>
                    @endforeach
                    @if(!sizeof($closedTickets))
                        <ul>
                            <li style="text-align: center;font-style: italic; width: 100%;">{{trans("support_alfiory::user.no_closed_ticket")}}</li>
                        </ul>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</div>

<script>
    $('.resolve-ticket').on('click', function () {
        if(confirm("{{trans('support_alfiory::user.resolve_ticket_confirmation')}}")) {
            let id = $(this).data("ticket-id");

            $.ajax({
                url: "{{route('support_alfiory.resolve_ticket')}}",
                type: "post",
                dataType: "html",
                data: 'id=' + id,
                headers: {
                    'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content'),
                },
                success: () => {
                    window.location.replace('{{route("support_alfiory.home")}}');
                },
            });
        }
    });
</script>
