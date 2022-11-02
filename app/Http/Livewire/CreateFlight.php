<?php

namespace App\Http\Livewire;

use App\Enum\FlightStatus;
use App\Models\Flight;
use Carbon\Carbon;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class CreateFlight extends Component implements HasForms
{
    use InteractsWithForms;

    public Flight $flight;

    public function mount(): void
    {
        $this->form->fill();
    }

    protected function getFormSchema(): array
    {
        return [
            Grid::make(1)->schema([
                Select::make('status')
                    ->optionsLimit(1)
                    ->options(FlightStatus::class)
                    ->default(FlightStatus::ACTIVE)
                    ->enum(FlightStatus::class),
                Fieldset::make(__('flights.create.form.fieldsets.base_data'))->schema([
                    TextInput::make(__('flights.create.form.registration'))
                        ->maxLength(20)
                        ->placeholder('HB-XYZ')
                        ->required()
                        ->alphaDash(),
                    TextInput::make(__('flights.create.form.model'))
                        ->maxLength(255)
                        ->placeholder('MONEY, BRAVO, ROBIN, ...')
                        ->required()
                        ->alphaNum(),
                    TextInput::make(__('flights.create.form.flight_number'))->maxLength(255)->alphaNum(),
                ])->columns(3),
                Fieldset::make(__('flights.create.form.fieldsets.nav'))->schema([
                    TextInput::make(__('flights.create.form.departure'))
                        ->maxLength(25)
                        ->placeholder('LSGG')
                        ->required()
                        ->alpha(),
                    TextInput::make(__('flights.create.form.arrival'))
                        ->maxLength(25)
                        ->placeholder('LSZH')
                        ->required()
                        ->alpha(),
                    DateTimePicker::make(__('flights.create.form.out'))
                        ->default(Carbon::now())
                        ->displayFormat('d.m.Y H:i')
                        ->required()
                        ->after('now'),
                    DateTimePicker::make(__('flights.create.form.in'))
                        ->default(Carbon::now()->addHour())
                        ->displayFormat('d.m.Y H:i')
                        ->required()
                        ->after(__('flights.create.form.out')),
                    Textarea::make(__('flights.create.form.metar'))
                        ->placeholder(__('flights.create.form.metar_placeholder'))
                        ->maxLength(255),
                    TextInput::make(__('flights.create.form.route'))
                        ->placeholder('N/A')
                        ->maxLength(255),
                    TextInput::make(__('flights.create.form.legs'))->numeric()->required()->default(1)->minValue(1),
                ]),
            ]),
        ];
    }

    protected function getFormModel(): string
    {
        return Flight::class;
    }

    protected function onValidationError(ValidationException $exception): void
    {
        Notification::make()
            ->title($exception->getMessage())
            ->danger()
            ->send();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render(): View
    {
        return view('components.flights.create-flight');
    }
}
