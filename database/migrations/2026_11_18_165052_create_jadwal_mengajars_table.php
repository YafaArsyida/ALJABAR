<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ej_jadwal_mengajar', function (Blueprint $table) {
            $table->bigIncrements('ej_jadwal_mengajar_id');

            $table->unsignedBigInteger('ms_penugasan_guru_id');

            $table->enum('hari', [
                'SENIN',
                'SELASA',
                'RABU',
                'KAMIS',
                'JUMAT',
                'SABTU',
                'MINGGU',
            ]);

            $table->time('jam_mulai');
            $table->time('jam_selesai');

            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();

            $table->enum('status', ['AKTIF', 'NONAKTIF'])
                  ->default('AKTIF');

            $table->text('deskripsi')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Index
            $table->index('ms_penugasan_guru_id');
            $table->index('hari');
            $table->index('status');

            // Index kombinasi jadwal
            $table->index(
                ['hari', 'jam_mulai', 'jam_selesai'],
                'idx_jadwal_hari_jam'
            );
        });
    }

    public function down()
    {
        Schema::dropIfExists('ej_jadwal_mengajar');
    }
};
