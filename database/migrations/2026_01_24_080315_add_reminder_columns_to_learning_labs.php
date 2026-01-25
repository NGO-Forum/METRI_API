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
        Schema::table('learning_labs', function (Blueprint $table) {
            $table->timestamp('reminder_3d_sent_at')->nullable();
            $table->timestamp('reminder_1d_sent_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('learning_labs', function (Blueprint $table) {
            //
        });
    }
};
