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
        Schema::create('pengajuan_histories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengajuan_id');
            $table->string('status'); 
            $table->string('by_name');
            $table->string('by_nik')->nullable();
            $table->text('note')->nullable();
            $table->timestamp('created_at')->useCurrent();
        
            $table->foreign('pengajuan_id')->references('pengajuan_id')->on('tbl_pengajuan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_histories');
    }
};
