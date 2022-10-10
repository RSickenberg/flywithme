<div class="ds-form-control">
    <label class="ds-label ds-cursor-pointer">
        <span class="ds-label-text mx-3">{{ __('flights.table.action.include_passed') }}</span>
        <input id="include_old_flights" name="with_old_flights" type="checkbox" class="ds-toggle ds-toggle-primary" {{ request()->input('old') ? 'checked' : '' }} />
    </label>
</div>
