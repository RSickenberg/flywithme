<?php

namespace App\Http\Livewire;

use App\Enum\FlightStatus;
use App\Models\Flight;
use Carbon\Carbon;
use Carbon\CarbonTimeZone;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Wizard;
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
                                ->minDate(now())->withoutSeconds()
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
                    ->description(__('flights.create.form.wizard.geo.desc'))->schema([
                    Grid::make()->schema([
                        Select::make('timezone_departure')
                            ->label(__('flights.create.form.timezone_departure'))
                            ->required()
                            ->options(CarbonTimeZone::listIdentifiers())->searchable()->optionsLimit(120),
                        Select::make('timezone_arrival')
                            ->label(__('flights.create.form.timezone_arrival'))
                            ->required()
                            ->options(CarbonTimeZone::listIdentifiers())->searchable()->optionsLimit(120),
                    ]),
                ]),
            ])->submitAction('<button type="submit" class="mt-8 ds-btn ds-btn-primary ds-btn-block text-black text-lg">{{ __(\'flights.add\') }}</button>'),
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
