<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('learning_lab_registrations', function (Blueprint $table) {
            $table->id();

            $table->foreignId('learning_lab_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('full_name');
            $table->string('organization');
            $table->string('role_position');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('province')->nullable();

            $table->boolean('is_ngof_member');
            // NGO name (ONLY if member)
            $table->string('ngo_name')->nullable();

            // Payment percentage (ONLY if NOT member)
            $table->unsignedTinyInteger('payment_percentage')->nullable();

            $table->text('special_needs')->nullable();

            $table->boolean('consent')->default(false);
            $table->unique(['learning_lab_id', 'email']);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('learning_lab_registrations');
    }
};
