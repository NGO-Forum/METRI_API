<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('learning_labs', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('topic');
            $table->string('time');          // e.g. 9:00–12:00
            $table->string('format');        // Online / In-person
            $table->text('speakers');        // Names & roles
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('learning_labs');
    }
};
