@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Ops!!!</strong> Existe algum problema no envio.<br /><br />
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

