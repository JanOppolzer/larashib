@if ($user->active)
    @unless (Auth::id() === $user->id)
        <form class="inline-block" action="{{ route('users.role', $user) }}" method="POST">
            @csrf
            @method('patch')
            <x-button color="indigo">
                {{ $user->admin ? __('users.revoke_admin') : __('users.grant_admin') }}
            </x-button>
        </form>
    @endunless
@endif
