<div class="container">
    <h2 class="page-title"><span>Cadeau à récupérer</span></h2>

    @if(session()->get('message') !== null)
        <div class="alert alert-{{ session()->get('alert') }}">{{ session()->get('message') }}</div>
    @endif

    <form method="POST" action="{{ route('Fetch_Gift_Visitor_Getting') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <label class="clearfix">Entrez le code cadeau:</label>
        <div class="pc-form col-12">
            <input type="text" placeholder="Code" class="form-control" name="code_get">
        </div>
        <button type="submit" class="btn btn-main">Récupérer mon cadeau !</button>
    </form>
</div>
