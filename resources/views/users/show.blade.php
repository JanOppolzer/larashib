@extends('layout')
@section('title', $user->name)

@section('content')

    <x-model-show>
        <x-row-top>{{ __('users.profile') }}</x-row-top>
        <x-row>
            <x-slot:term>{{ __('common.name') }}</x-slot:term>
            {{ $user->name }}
            <div class="inline-block pl-4 space-x-4">
                <x-pills.user-status :$user />
                <x-pills.user-role :$user />
            </div>
        </x-row>
        <x-row>
            <x-slot:term>{{ __('common.uniqueid') }}</x-slot:term>
            <code class="text-sm text-pink-500">{{ $user->uniqueid }}</code>
        </x-row>
        <x-row>
            <x-slot:term>{{ __('common.email') }}</x-slot:term>
            <x-a href="mailto:{{ $user->email }}">{{ $user->email }}</x-a>
        </x-row>
        <div class="even:bg-gray-50 odd:bg-white px-4 py-5">
            <x-link-button href="{{ URL::previous() }}" text="{{ __('common.back') }}" />
            <x-forms.user-status :$user />
            <x-forms.user-role :$user />
        </div>
    </x-model-show>

@endsection
