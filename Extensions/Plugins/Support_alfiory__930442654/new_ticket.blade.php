<div  class="container">
    <a class="btn btn-light mb-4" href="{{route('support_alfiory.home')}}"><i class="fas fa-chevron-left"></i> {{trans('support_alfiory::user.return_to_tickets')}}</a>

    <h2 class="page-title"><span>{{trans('support_alfiory::user.open_ticket')}}</span></h2>


    <form class="form" method="post" action="">
        @csrf

        <label>{{trans('support_alfiory::user.category')}}</label>
        <div class="pc-form select">
            <input name="category" type="hidden" value="{{$categories[0]->id}}">
            <div name="categorie" class="fake-select">
                <div class="options-container">
                    <div class="fake-option selected"><span>{{$categories[0]->name}}</span></div>

                    @php $i=0; @endphp
                    @foreach($categories as $s)
                        <div class="fake-option<?= ($i==0)? ' active': '' ?>" data-value="{{ $s->id }}">
                            <span>{{ $s->name }}</span>
                        </div>
                        @php $i++; @endphp
                    @endforeach
                </div>
                <i class="fas fa-chevron-down"></i>
            </div>
        </div>
        @error('category') <div class="pc-form-error">{{$message}}</div> @enderror

        <label>{{trans('support_alfiory::user.subject')}}</label>
        <div class="pc-form">
            <input type="text" class="form-control" name="subject" value="{{old('subject')}}" placeholder="{{trans('support_alfiory::user.subject')}}">
        </div>
        @error('subject') <div class="pc-form-error">{{$message}}</div> @enderror

        <label>{{trans('support_alfiory::user.message')}}</label>
        <div class="pc-form textarea">
            <textarea name="message" class="form-control" rows="3" placeholder="{{trans('support_alfiory::user.message')}}">{{old('message')}}</textarea>
        </div>
        @error('message') <div class="pc-form-error">{{$message}}</div> @enderror
        
        <button type="submit" class="btn btn-main mt-2">{{trans('support_alfiory::user.validate')}}</button>
    </form>
</div>
