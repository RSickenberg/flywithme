<?php

use App\Enum\FlightStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('flights', static function (Blueprint $table) {
            $table->ulid('id')->unique();
            $table->string('registration')->comment('The aircraft plate');
            $table->string('model')->comment('The aircraft model');
            $table->string('flight_number')->nullable();
            $table->string('departure')->comment('The airport departure ICAO code');
            $table->string('arrival')->comment('The airport destination ICAO code');
            $table->dateTimeTz('out')->comment('The date and hour of departure');
            $table->dateTimeTz('in')->comment('The date and hour of arrival');
            $table->string('metar')->nullable()->comment('The metar of the flight');
            $table->string('route')->comment('The route used')->default('N/A');
            $table->point('departure_location')->nullable();
            $table->point('arrival_location')->nullable();
            $table->enum('status', array_map(static fn(BackedEnum $enum) => $enum->value, FlightStatus::cases()));
            $table->timestampsTz();
        });

        Schema::create('flights_times', static function (Blueprint $table) {
            $table->ulid('id')->unique();
            $table->foreignUlid('flight_id')
                ->constrained()
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->time('total')->nullable();
            $table->time('night')->nullable();
            $table->time('xc')->nullable();
            $table->time('actual_inst')->nullable();
            $table->time('pic')->nullable();
            $table->time('sic')->nullable();
            $table->time('dual_rcvd')->nullable();
            $table->time('solo')->nullable();

            $table->unsignedInteger('day_to')->nullable();
            $table->unsignedInteger('night_to')->nullable();
            $table->unsignedInteger('day_ldg')->nullable();
            $table->unsignedInteger('night_ldg')->nullable();

            $table->text('remarks')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
        Schema::dropIfExists('flights_times');
    }

};
