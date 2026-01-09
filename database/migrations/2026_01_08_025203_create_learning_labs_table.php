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
            $table->string('time'); 
            $table->enum('format', ['online', 'in_person', 'hybrid']); 
            $table->string('link')->nullable();    
            $table->text('description');   
            $table->text('speakers');      
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('learning_labs');
    }
};
