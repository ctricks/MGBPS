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
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->string('LeaveKey', 100)->unique();
            $table->string('EmpCode');
            $table->integer('LeaveType')->unsigned();
            $table->string('Remarks', 100)->nullable();
            $table->datetime('StartDate');
            $table->datetime('EndDate');
            $table->datetime('ApprovedDate');
            $table->integer('ApprovedBy');
            $table->string('Status');
            $table->integer('isActive')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
};
