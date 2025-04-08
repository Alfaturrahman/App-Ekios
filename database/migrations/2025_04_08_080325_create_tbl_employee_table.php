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
        Schema::create('tbl_employee', function (Blueprint $table) {
            $table->id('employee_id');
            $table->string('employee_name');
            $table->string('employee_badge')->unique();
            $table->string('password');
            $table->unsignedBigInteger('jabatan_id');
            $table->unsignedBigInteger('department_id');
            $table->timestamps();
    
            $table->foreign('jabatan_id')->references('jabatan_id')->on('tbl_jabatan');
            $table->foreign('department_id')->references('department_id')->on('tbl_department');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_employee');
    }
};
