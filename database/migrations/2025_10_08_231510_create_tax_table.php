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
        Schema::create('tax', function (Blueprint $table) {
            $table->id();
            $table->string('PayType', 100);
            $table->decimal('StartRange', 10, 2);
            $table->decimal('EndRange', 10, 2);
            $table->decimal('OverMinimum', 10, 2);
            $table->decimal('AddPercent', 10, 2);
            $table->decimal('AdditionalPay', 10, 2);
            $table->integer('UploadedBy')->nullable()->default(-1);
            $table->integer('UpdatedBy')->nullable()->default(-1);
            $table->integer('Year')->default(-1);
            $table->integer('isActive')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tax');
    }
};
