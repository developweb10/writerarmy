@if (count($errors) > 0)
    <br>
    <div class="alert alert-danger">
        <strong>Whoops!</strong><br>
        <ul class="list-unstyled">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif