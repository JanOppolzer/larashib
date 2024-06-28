@props(['user'])

@unless ($user->trashed() or !$user->active)
    @if ($user->admin)
        <span @class([
            'px-2 text-xs font-semibold rounded-full text-indigo-800 bg-indigo-100',
        ])>
            {{ __('common.admin') }}
        </span>
    @endif
@endunless
