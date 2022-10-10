<?php

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
        Schema::create('statistics', static function (Blueprint $table) {
            $table->ulid();
            $table->unsignedInteger('number_of_flights');
            $table->unsignedInteger('passengers')->comment('Total taken');
            $table->unsignedInteger('distance')->comment('Distance in NM');
            $table->timestampsTz();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('statistics');
    }
};
