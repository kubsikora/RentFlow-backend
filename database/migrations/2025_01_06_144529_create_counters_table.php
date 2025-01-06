<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('counters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type', 1);
            $table->string('operator');
            $table->string('unit', 5);
            $table->timestamps();
        });

        DB::table('counters')->insert([
            ['id' => 1, 'name' => 'energy', 'type' => 'E', 'operator' => 'TAURON', 'unit' => 'kWh', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'water', 'type' => 'W', 'operator' => 'PWIK', 'unit' => 'm3', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 3, 'name' => 'gas', 'type' => 'G', 'operator' => 'PGNIG', 'unit' => 'm3', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 4, 'name' => 'heat', 'type' => 'H', 'operator' => 'NAN', 'unit' => 'GJ', 'created_at' => now(), 'updated_at' => now()]
        ]);

        Schema::create('counters_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('counter_id');
            $table->unsignedBigInteger('place_id');
            $table->float('value');
            $table->timestamps();

            $table->foreign('counter_id')->references('id')->on('counters')->onDelete('cascade');
            $table->foreign('place_id')->references('id')->on('places')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('counters');
        Schema::dropIfExists('counters_data');
    }
};
