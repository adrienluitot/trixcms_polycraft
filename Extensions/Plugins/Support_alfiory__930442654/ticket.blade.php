<link rel="stylesheet" href="@ThemeAssets('css/support.css')">

<div class="container">
    <a class="btn btn-light mb-4" href="{{route('support_alfiory.home')}}"><i class="fas fa-chevron-left"></i> {{trans('support_alfiory::user.return_to_tickets')}}</a>

    <h2 class="page-title"><span>{{trans('support_alfiory::user.ticket')}} "{{ $ticket->subject }}"</span></h2>

    <div class="row support-container">
        <div class="col-12">
            @if(session('support_flash'))
                <div class="alert alert-{{session('support_flash')['state']}}">
                    {{session('support_flash')['message']}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @php $lastUser = -1; @endphp
            @foreach($ticketMessages as $message)
                 <div class="ticket-message{{ ($message->member_id != user()->id)? ' support-answer':'' }}">
                    @if($message->member_id != $lastUser)
                        <span class="message-author">
                            <img src="{{ avatar($message->member_id) }}">
                            {{($message->member_id == user()->id)? trans('support_alfiory::user.you') : $message->pseudo}}
                        </span>
                    @endif
            
                    <div class="message-content">
                        <p><?= nl2br(e($message->content)); ?></p>
                    </div>
                </div>
                @php $lastUser = $message->member_id; @endphp
            @endforeach

            <hr class="my-5">

            @if(!$ticket->resolved)
                <div class="writing-zone mt-3">
                    <form method="post" action="">
                        @csrf

                        @error('answer')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror

                        <div class="pc-form textarea mb-2">
                            <textarea rows="3" placeholder="{{trans('support_alfiory::user.answer')}}" name="answer" class="form-control"></textarea>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-main">{{trans('support_alfiory::user.send')}}</button>
                        </div>

                        <div class="col-12 mt-5">
                            <button type="button" id="resolve-ticket" class="btn btn-main"><i class="fas fa-check"></i> {{trans('support_alfiory::user.resolve_ticket')}}</button>
                        </div>
                    </form>
                </div>
            @else
                <div class="alert alert-warning">{{trans('support_alfiory::user.ticket_has_been_resolved')}}</div>
            @endif
        </div>
    </div>
</div>

@if(!$ticket->resolved)
    <script>
        $('#resolve-ticket').on('click', function () {
            if(confirm("{{trans('support_alfiory::user.resolve_ticket_confirmation')}}")) {
                $.ajax({
                    url: "{{route('support_alfiory.resolve_ticket')}}",
                    type: "post",
                    dataType: "html",
                    data: 'id={{$ticket->id}}',
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
@endif