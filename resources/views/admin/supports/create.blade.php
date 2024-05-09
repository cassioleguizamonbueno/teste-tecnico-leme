<h1>Nova Dúvida</h1>

<x-alert/>

<form action="{{ route('supports.store') }}" method="post">
    {{--input type="text" value="{{ csrf_token() }}" name="_token" --}}
        @include('admin.supports.partials.form')
</form>


