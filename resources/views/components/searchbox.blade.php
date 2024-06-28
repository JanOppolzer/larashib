@props(['models'])

<div class="mb-4">
    <form>
        <label class="sr-only" for="searchbox">{{ __('common.search') }}</label>
        <input wire:model.live="search" class="w-full px-4 py-2 border rounded-lg" type="text" name="search"
            id="searchbox" placeholder="{{ __("inputs.searchbox_{$models}") }}" autofocus>
    </form>
    <div wire:loading class="font-bold">
        {{ __("inputs.please_wait_loading_{$models}") }}
    </div>
</div>
