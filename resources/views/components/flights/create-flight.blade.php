<form wire:submit.prevent="submit">
    {{ $this->form }}

    <button type="submit" class="mt-8 ds-btn ds-btn-primary ds-btn-block text-black text-lg">
        {{ __('flights.add') }}
    </button>
</form>
