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
        Schema::create('ms_periode_akademik', function (Blueprint $table) {
            $table->bigIncrements('ms_periode_akademik_id');

            $table->string('nama_periode', 100);

            $table->unsignedBigInteger('ms_jenjang_id');
            $table->unsignedBigInteger('ms_tahun_ajar_id');

            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai')->nullable();

            $table->unsignedInteger('urutan')->default(1);

            $table->enum('status', ['AKTIF', 'NONAKTIF'])
                  ->default('AKTIF');

            $table->text('deskripsi')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Index
            $table->index('ms_jenjang_id');
            $table->index('ms_tahun_ajar_id');
            $table->index('status');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ms_periode_akademik');
    }
};
