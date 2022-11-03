<?php

namespace App\Http\Livewire;

use App\Enum\FlightStatus;
use App\Models\Flight;
use Carbon\Carbon;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Illuminate\Support\HtmlString;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Tapp\FilamentTimezoneField\Forms\Components\TimezoneSelect;

class CreateFlight extends Component implements HasForms
{
    use InteractsWithForms;

    public Flight $flight;

    public mixed $data;

    public function mount(): void
    {
        $this->form->fill();
    }

    public function create(): void
    {
        Flight::create($this->form->getState());
    }

    protected function getFormSchema(): array
    {
        return [
            Wizard::make([
                Wizard\Step::make(__('flights.create.form.wizard.general'))
                    ->icon('heroicon-s-identification')
                    ->schema([
                        Grid::make(1)->schema([
                            Select::make('status')
                                ->label(__('flights.create.form.status'))
                                ->options(FlightStatus::class)
                                ->default(FlightStatus::ACTIVE)
                                ->enum(FlightStatus::class),
                            Fieldset::make(__('flights.create.form.fieldsets.base_data'))->schema([
                                TextInput::make('registration')
                                    ->label(__('flights.create.form.registration'))
                                    ->maxLength(20)
                                    ->placeholder('HB-XYZ')
                                    ->required()
                                    ->alphaDash(),
                                TextInput::make('model')
                                    ->label(__('flights.create.form.model'))
                                    ->maxLength(255)
                                    ->placeholder('MONEY, BRAVO, ROBIN, ...')
                                    ->required()
                                    ->alphaNum(),
                                TextInput::make('flight_number')
                                    ->label(__('flights.create.form.flight_number'))
                                    ->maxLength(255)
                                    ->alphaNum(),
                            ])->columns(3),
                            Fieldset::make('nav')->schema([
                                TextInput::make('departure')
                                    ->label(__('flights.create.form.departure'))
                                    ->maxLength(25)
                                    ->placeholder('LSGG')
                                    ->required()->alpha(),
                                TextInput::make('arrival')
                                    ->label(__('flights.create.form.arrival'))
                                    ->maxLength(25)
                                    ->placeholder('LSZH')
                                    ->required()->alpha(),
                                DateTimePicker::make('out')
                                    ->label(__('flights.create.form.out'))
                                    ->default(Carbon::now())
                                    ->displayFormat('d.m.Y H:i')
                                    ->minDate(now()->subMinute())->withoutSeconds()
                                    ->required()->after('now'),
                                DateTimePicker::make('in')
                                    ->label(__('flights.create.form.in'))
                                    ->default(Carbon::now()->addHour())
                                    ->displayFormat('d.m.Y H:i')
                                    ->withoutSeconds()
                                    ->required()->after('out'),
                                Textarea::make('metar')
                                    ->label(__('flights.create.form.metar'))
                                    ->placeholder(__('flights.create.form.metar_placeholder'))
                                    ->maxLength(255),
                                TextInput::make('route')
                                    ->label(__('flights.create.form.route'))
                                    ->placeholder('N/A')
                                    ->maxLength(255),
                                TextInput::make('legs')
                                    ->label(__('flights.create.form.legs'))
                                    ->numeric()
                                    ->required()
                                    ->default(1)->minValue(1),
                            ]),
                        ]),
                    ]),
                Wizard\Step::make(__('flights.create.form.wizard.geo.label'))
                    ->icon('heroicon-s-globe-alt')
                    ->description(__('flights.create.form.wizard.geo.desc'))->schema($this->buildLocationForm()),
            ])->submitAction(new HtmlString('<button type="submit" class="mt-8 ds-btn ds-btn-accent ds-btn-block text-black text-lg">' . __("flights.add") . '</button>')),
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

    protected function getFormStatePath(): string
    {
        return 'data';
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

    private function buildLocationForm(): array
    {
        return [
            Grid::make()->schema([
                Fieldset::make(__('flights.create.form.fieldsets.tz'))->schema([
                    TimezoneSelect::make('timezone_departure')
                        ->label(__('flights.create.form.timezone_departure'))
                        ->searchable()
                        ->required(),
                    TimezoneSelect::make('timezone_arrival')
                        ->label(__('flights.create.form.timezone_arrival'))
                        ->searchable()
                        ->required(),
                ]),
                Fieldset::make(__('flights.create.form.fieldsets.geo'))->schema([
                    Section::make(__('flights.create.form.location.dp_heading'))->schema([
                        TextInput::make('departure_location_lat')
                            ->numeric()->required()
                            ->label(__('flights.create.form.location.departure'))
                            ->placeholder('46.5266079930082')
                            ->hint('Latitude')
                            ->mask(static fn(TextInput\Mask $mask) => $mask->numeric()->decimalPlaces(2)),
                        TextInput::make('departure_location_long')
                            ->numeric()->required()
                            ->label(__('flights.create.form.location.departure'))
                            ->placeholder('6.596511300367413')
                            ->hint('Longitude')
                            ->mask(static fn(TextInput\Mask $mask) => $mask->numeric()->decimalPlaces(2)),
                    ]),
                    Section::make(__('flights.create.form.location.ar_heading'))->schema([
                        TextInput::make('arrival_location_lat')
                            ->numeric()->required()
                            ->label(__('flights.create.form.location.arrival'))
                            ->placeholder('46.5266079930082')
                            ->hint('Latitude')
                            ->mask(static fn(TextInput\Mask $mask) => $mask->numeric()->decimalPlaces(2)),
                        TextInput::make('arrival_location_long')
                            ->numeric()->required()
                            ->label(__('flights.create.form.location.arrival'))
                            ->placeholder('6.596511300367413')
                            ->hint('Longitude')
                            ->mask(static fn(TextInput\Mask $mask) => $mask->numeric()->decimalPlaces(2)),
                    ]),
                ]),
            ]),
        ];
    }
}
