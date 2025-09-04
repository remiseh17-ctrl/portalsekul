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
        Schema::table('tugas', function (Blueprint $table) {
            // Drop foreign key constraints first
            $table->dropForeign(['jadwal_id']);
            $table->dropForeign(['guru_id']);
            $table->dropForeign(['kelas_id']);
            
            // Drop columns that are not needed for admin tasks
            $table->dropColumn(['jadwal_id', 'guru_id', 'kelas_id']);
            
            // Add new field for drive link
            $table->string('link_drive')->nullable()->after('file');
            
            // Add field to track if task is for all teachers
            $table->boolean('untuk_semua_guru')->default(true)->after('link_drive');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tugas', function (Blueprint $table) {
            // Recreate the original structure
            $table->foreignId('jadwal_id')->nullable()->constrained('jadwals')->onDelete('cascade');
            $table->foreignId('guru_id')->nullable()->constrained('gurus')->onDelete('cascade');
            $table->foreignId('kelas_id')->nullable()->constrained('kelas')->onDelete('cascade');
            
            // Drop new fields
            $table->dropColumn(['link_drive', 'untuk_semua_guru']);
        });
    }
};
