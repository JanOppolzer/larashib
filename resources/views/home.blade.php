@extends('layout')
@section('title', __('common.dashboard'))

@section('content')

    <p class="mb-6">
        {!! __('welcome.introduction') !!}
    </p>

    <p>
        {!! __('welcome.contact') !!} <x-a href="mailto:708@cesnet.cz">708@cesnet.cz</x-a>.
    </p>

@endsection
