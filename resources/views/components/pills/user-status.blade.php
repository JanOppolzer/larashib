@props(['user'])

@unless ($user->trashed())
    <span @class([
        'px-2 text-xs font-semibold rounded-full',
        'text-green-800 bg-green-100' => $user->active,
        'text-red-800 bg-red-100' => !$user->active,
    ])>
        {{ $user->active ? __('common.active') : __('common.inactive') }}
    </span>
@else
    <span @class([
        'px-2 text-xs font-semibold rounded-full',
        'text-red-800 bg-red-100',
    ])>
        {{ __('users.softdeleted') }}
    </span>
@endunless
