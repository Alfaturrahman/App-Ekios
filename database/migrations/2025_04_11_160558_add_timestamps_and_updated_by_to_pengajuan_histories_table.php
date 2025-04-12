<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('pengajuan_histories', function (Blueprint $table) {
            if (!Schema::hasColumn('pengajuan_histories', 'created_at')) {
                $table->timestamp('created_at')->nullable()->after('created_by');
            }
            if (!Schema::hasColumn('pengajuan_histories', 'updated_at')) {
                $table->timestamp('updated_at')->nullable()->after('created_at');
            }
            if (!Schema::hasColumn('pengajuan_histories', 'updated_by')) {
                $table->unsignedBigInteger('updated_by')->nullable()->after('updated_at');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('pengajuan_histories', function (Blueprint $table) {
            if (Schema::hasColumn('pengajuan_histories', 'created_at')) {
                $table->dropColumn('created_at');
            }
            if (Schema::hasColumn('pengajuan_histories', 'updated_at')) {
                $table->dropColumn('updated_at');
            }
            if (Schema::hasColumn('pengajuan_histories', 'updated_by')) {
                $table->dropColumn('updated_by');
            }
        });
    }
};
