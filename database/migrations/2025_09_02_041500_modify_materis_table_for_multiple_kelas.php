<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyMaterisTableForMultipleKelas extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('materis', function (Blueprint $table) {
            // Hapus foreign key constraint untuk jadwal_id
            $table->dropForeign(['jadwal_id']);

            // Buat jadwal_id nullable
            $table->foreignId('jadwal_id')->nullable()->change();

            // Tambah kolom untuk shared kelas (JSON array)
            $table->json('shared_kelas')->nullable()->after('kelas_id');

            // Buat ulang foreign key constraint dengan nullable
            $table->foreign('jadwal_id')->references('id')->on('jadwals')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('materis', function (Blueprint $table) {
            // Hapus kolom shared_kelas
            $table->dropColumn('shared_kelas');

            // Hapus foreign key constraint
            $table->dropForeign(['jadwal_id']);

            // Kembalikan jadwal_id ke required
            $table->foreignId('jadwal_id')->change();

            // Buat ulang foreign key constraint
            $table->foreign('jadwal_id')->references('id')->on('jadwals')->onDelete('cascade');
        });
    }
};