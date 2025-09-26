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
        Schema::create('cutoff', function (Blueprint $table) {
            $table->id();
            $table->string('CutoffKey')->unique();
            $table->string('Month');
            $table->date('StartDate');
            $table->date('EndDate');
            $table->string('Status')->nullable();
            $table->integer('OpenBy')->default(-1);
            $table->timestamp('OpenDate')->nullable();
            $table->integer('ClosedBy')->default(-1);
            $table->timestamp('ClosedDate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cutoff');
    }
};
