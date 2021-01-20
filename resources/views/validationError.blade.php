@if($errors->has($attribute))
    <div>
        @foreach($errors->get($attribute) as $error)
            <p class="alert-danger">{{ $error }}</p>
        @endforeach
    </div>
@endif