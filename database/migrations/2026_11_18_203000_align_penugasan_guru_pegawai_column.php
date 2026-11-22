<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('ms_penugasan_guru')
            || !Schema::hasColumn('ms_penugasan_guru', 'ms_guru_id')
            || Schema::hasColumn('ms_penugasan_guru', 'ms_pegawai_id')) {
            return;
        }

        Schema::table('ms_penugasan_guru', function (Blueprint $table) {
            $table->dropUnique('unique_penugasan_guru');
            $table->dropIndex('ms_penugasan_guru_ms_guru_id_index');
            $table->renameColumn('ms_guru_id', 'ms_pegawai_id');
        });

        Schema::table('ms_penugasan_guru', function (Blueprint $table) {
            $table->index('ms_pegawai_id', 'idx_penugasan_guru_pegawai');
            $table->unique([
                'ms_pegawai_id',
                'ms_kelas_id',
                'ms_mata_pelajaran_id',
                'ms_periode_akademik_id',
            ], 'unique_penugasan_guru');
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('ms_penugasan_guru')
            || !Schema::hasColumn('ms_penugasan_guru', 'ms_pegawai_id')
            || Schema::hasColumn('ms_penugasan_guru', 'ms_guru_id')) {
            return;
        }

        Schema::table('ms_penugasan_guru', function (Blueprint $table) {
            $table->dropUnique('unique_penugasan_guru');
            $table->dropIndex('idx_penugasan_guru_pegawai');
            $table->renameColumn('ms_pegawai_id', 'ms_guru_id');
        });

        Schema::table('ms_penugasan_guru', function (Blueprint $table) {
            $table->index('ms_guru_id');
            $table->unique([
                'ms_guru_id',
                'ms_kelas_id',
                'ms_mata_pelajaran_id',
                'ms_periode_akademik_id',
            ], 'unique_penugasan_guru');
        });
    }
};
