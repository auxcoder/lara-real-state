<div class="p-3 bg-light-subtle rounded-3 row">
    <h3 class="text-center">{{ __('notify.heading') }}</h3>
    <p class="">{{ __('notify.description') }}</p>

    <form method="POST" action="{{ route('test.email') }}">
        @csrf
        <div class="input-group">
            <input
                type="email"
                class="form-control""
                placeholder="{{ __('notify.email_placeholder') }}"
                name="email"
                required
            />
            <button type="submit" class="btn btn-outline-secondary" >
                <i class="fa-solid fa-paper-plane"></i>
            </button>
        </div>
    </form>
</div>
