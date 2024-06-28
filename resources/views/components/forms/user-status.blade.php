@unless ($user->trashed())
    @unless (Auth::id() === $user->id)
        <form class="inline-block" action="{{ route('users.status', $user) }}" method="POST">
            @csrf
            @method('patch')
            <x-button color="{{ $user->active ? 'red' : 'green' }}">
                {{ $user->active ? __('common.deactivate') : __('common.activate') }}
            </x-button>
        </form>
    @endunless
@endunless
