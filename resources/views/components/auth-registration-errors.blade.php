
@props(['errors'])

@if ($errors->any())
    <div {{ $attributes }}>
        @foreach ($errors->all() as $error)
            @if (str_contains($error, 'already') || str_contains($error, 'taken'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <div>
                            <strong>{{ $error }}</strong>
                            <p class="mb-0 mt-1">Looks like you already have an account.
                                <a href="{{ route('login') }}" class="alert-link">Click here to login</a>
                            </p>
                        </div>
                    </div>
                    <button type="button" class="btn-close" onclick="this.closest('.alert').remove()" aria-label="Close"></button>
                </div>
            @else
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>{{ $error }}</strong>
                    </div>
                    <button type="button" class="btn-close" onclick="this.closest('.alert').remove()" aria-label="Close"></button>
                </div>
            @endif
        @endforeach
    </div>
@endif
