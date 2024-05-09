<h1>Dúvida {{ $support->id }}</h1>

<x-alert/>

<form action="{{ route('supports.update', $support->id ) }}" method="post">
    {{--input type="text" value="{{ csrf_token() }}" name="_token" --}}
    {{-- input type="text" value="PUT" name="_method" --}}
    @method('PUT')
    @include('admin.supports.partials.form', [
        'support' => $support
    ])
</form>


