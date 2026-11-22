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
        Schema::create('ms_penugasan_guru', function (Blueprint $table) {
            $table->bigIncrements('ms_penugasan_guru_id');

            $table->unsignedBigInteger('ms_guru_id');
            $table->unsignedBigInteger('ms_kelas_id');
            $table->unsignedBigInteger('ms_mata_pelajaran_id');
            $table->unsignedBigInteger('ms_periode_akademik_id');

            $table->enum('status', ['AKTIF', 'NONAKTIF'])
                  ->default('AKTIF');

            $table->text('deskripsi')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Index untuk optimasi query
            $table->index('ms_guru_id');
            $table->index('ms_kelas_id');
            $table->index('ms_mata_pelajaran_id');
            $table->index('ms_periode_akademik_id');
            $table->index('status');

            // Mencegah duplikasi penugasan
            $table->unique(
                [
                    'ms_guru_id',
                    'ms_kelas_id',
                    'ms_mata_pelajaran_id',
                    'ms_periode_akademik_id',
                ],
                'unique_penugasan_guru'
            );
        });
    }

    public function down()
    {
        Schema::dropIfExists('ms_penugasan_guru');
    }
};
