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
        Schema::create('tbl_pengajuan', function (Blueprint $table) {
            $table->id('pengajuan_id');
            $table->unsignedBigInteger('employee_id');
            $table->string('brand_type');
            $table->string('nama_hp');
            $table->string('os_type');
            $table->string('imei1');
            $table->string('imei2')->nullable();
            $table->string('submission_type');
            $table->string('foto_depan');
            $table->string('foto_belakang');
            $table->string('approve_HRD')->nullable(); // bisa pakai ENUM juga
            $table->string('reason_HRD')->nullable();
            $table->string('approve_QHSE')->nullable();
            $table->string('reason_QHSE')->nullable();
            $table->timestamps();

            $table->foreign('employee_id')->references('employee_id')->on('tbl_employee');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_pengajuan');
    }
};
