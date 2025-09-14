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
        Schema::create('holiday', function (Blueprint $table) {
            $table->id();
            $table->integer('Year');
            $table->string('HolidayName')->unique();
            $table->date('Date');
            $table->string('HolidayType');
            $table->integer('isActive')->default(1);
            $table->datetime('UpdatedDate')->nullable();
            $table->integer('UpdatedBy')->default(-1);
            $table->integer('CreatedBy')->default(-1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('holiday');
    }
};
