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
        Schema::create('overtimetype', function (Blueprint $table) {
            $table->id()->increment();
            $table->string('OvertimeType')->unique();
            $table->string('Description')->nullable();
            $table->decimal('OTMultiplier')->default(0.00);
            $table->string('isActive')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('overtimetype');
    }
};
