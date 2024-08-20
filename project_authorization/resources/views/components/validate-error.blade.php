@props(['errors'])

@if ($errors)
    <div {{ $attributes->merge(['class' => 'invalid-feedback']) }}>
        @foreach ((array) $errors as $error)
            {{ $error }}
        @endforeach
    </div>
@endif
