@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>
        <div class="fw-bold text-center text-danger">
            {{ __('Whoops! Something went wrong.') }}
        </div>

        <ul class="p-0 text-sm text-center text-danger">
            @foreach ($errors->all() as $error)
                <p class="text-center">{{ $error }}</p>
                
            @endforeach
        </ul>
    </div>
@endif
