<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, add the column if it doesn't exist
        if (!Schema::hasColumn('nilais', 'jenis_penilaian_id')) {
            Schema::table('nilais', function (Blueprint $table) {
                $table->unsignedBigInteger('jenis_penilaian_id')->default(0);
            });
        }

        // Then update nilai records that have jenis_penilaian_id = 0 to use tugas (id = 1)
        DB::table('nilais')
            ->where('jenis_penilaian_id', 0)
            ->update(['jenis_penilaian_id' => 1]); // 1 = tugas
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to 0 (though this might not be desired)
        DB::table('nilais')
            ->where('jenis_penilaian_id', 1)
            ->update(['jenis_penilaian_id' => 0]);

        // Remove the column if it exists
        if (Schema::hasColumn('nilais', 'jenis_penilaian_id')) {
            Schema::table('nilais', function (Blueprint $table) {
                $table->dropColumn('jenis_penilaian_id');
            });
        }
    }
};
