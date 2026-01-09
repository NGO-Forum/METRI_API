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
        Schema::create('interest_registrations', function (Blueprint $table) {
            $table->id();

            $table->string('full_name');
            $table->string('organization');
            $table->string('role_position');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('province')->nullable();

            $table->json('interests')->nullable();
            $table->boolean('consent')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interest_registrations');
    }
};
