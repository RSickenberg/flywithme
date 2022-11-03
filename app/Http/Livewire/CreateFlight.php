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
use MatanYadaev\EloquentSpatial\Objects\Point;
use Tapp\FilamentTimezoneField\Forms\Components\TimezoneSelect;

class CreateFlight extends Component implements HasForms
{
    use InteractsWithForms;

    public Flight $flight;

    public mixed $data = null;

    private const UPPERCASE_KEYS = [
        'registration',
        'model',
        'departure',
        'arrival',
        'route',
        'metar',
    ];

    public function mount(): void
    {
        $this->flight = new Flight();

        $this->form->fill();
    }

    public function submit(): void
    {
        $state = $this->form->getState();

        // Uppercase needed words
        foreach (self::UPPERCASE_KEYS as $keys) {
            if ($text = $state[$keys]) {
                $state[$keys] = strtoupper($text);
            }
        }

        // Set the carbon instance.
        $state['out'] = Carbon::parse($state['out'], 'UTC');
        $state['in'] = Carbon::parse($state['in'], 'UTC');

        $state['departure_location'] = new Point($state['departure_location_lat'], $state['departure_location_long']);
        $state['arrival_location'] = new Point($state['arrival_location_lat'], $state['arrival_location_long']);
        unset($state['departure_location_lat'], $state['departure_location_long'], $state['arrival_location_lat'], $state['arrival_location_long']);

        $flight = $this->flight->create($state);
        $flight->times()->create();

        Notification::make()
            ->title('The flight have been created successfully!')
            ->success()
            ->send();

        redirect()->route('flight_index');
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
                                    ->hint('Zulu time')->timezone('UTC')
                                    ->default(Carbon::now())
                                    ->displayFormat('d.m.Y H:i')
                                    ->minDate(now()->subMinutes(30))->withoutSeconds()
                                    ->required()->after('now'),
                                DateTimePicker::make('in')
                                    ->label(__('flights.create.form.in'))
                                    ->hint('Zulu time')->timezone('UTC')
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
            ])->submitAction(new HtmlString('<button type="submit" class="mt-8 ds-btn ds-btn-accent text-black">'.__('flights.add').'</button>')),
        ];
    }

    protected function getFormModel(): Flight
    {
        return $this->flight;
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
        $decimalPlaces = 5;

        return [
            Grid::make()->schema([
                Fieldset::make(__('flights.create.form.fieldsets.tz'))->schema([
                    TimezoneSelect::make('out_tz')
                        ->label(__('flights.create.form.timezone_departure'))
                        ->searchable()
                        ->required(),
                    TimezoneSelect::make('in_tz')
                        ->label(__('flights.create.form.timezone_arrival'))
                        ->searchable()
                        ->required(),
                ]),
                Fieldset::make(__('flights.create.form.fieldsets.geo'))->schema([
                    Section::make(__('flights.create.form.location.dp_heading'))->schema([
                        TextInput::make('departure_location_lat')
                            ->numeric()->required()
                            ->label(__('flights.create.form.location.departure'))
                            ->placeholder('46.52660')
                            ->hint('Latitude')
                            ->mask(static fn (TextInput\Mask $mask) => $mask->numeric()->decimalPlaces($decimalPlaces)),
                        TextInput::make('departure_location_long')
                            ->numeric()->required()
                            ->label(__('flights.create.form.location.departure'))
                            ->placeholder('6.59651')
                            ->hint('Longitude')
                            ->mask(static fn (TextInput\Mask $mask) => $mask->numeric()->decimalPlaces($decimalPlaces)),
                    ]),
                    Section::make(__('flights.create.form.location.ar_heading'))->schema([
                        TextInput::make('arrival_location_lat')
                            ->numeric()->required()
                            ->label(__('flights.create.form.location.arrival'))
                            ->placeholder('46.52660')
                            ->hint('Latitude')
                            ->mask(static fn (TextInput\Mask $mask) => $mask->numeric()->decimalPlaces($decimalPlaces)),
                        TextInput::make('arrival_location_long')
                            ->numeric()->required()
                            ->label(__('flights.create.form.location.arrival'))
                            ->placeholder('6.59651')
                            ->hint('Longitude')
                            ->mask(static fn (TextInput\Mask $mask) => $mask->numeric()->decimalPlaces($decimalPlaces)),
                    ]),
                ]),
            ]),
        ];
    }
}
