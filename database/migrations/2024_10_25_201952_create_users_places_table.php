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
        Schema::create('users_places', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('resident_id');
            $table->unsignedBigInteger('owner_id');
            $table->unsignedBigInteger('place_id');
            $table->integer('rooms')->default(1);
            $table->date('start_living');
            $table->date('end_living')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('resident_id')->references('id')->on('users')->onDelete('cascade');

            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');

            $table->foreign('place_id')->references('id')->on('places')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_places');
    }
};
