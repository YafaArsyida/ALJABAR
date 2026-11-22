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
        Schema::create('ms_mata_pelajaran', function (Blueprint $table) {
            $table->bigIncrements('ms_mata_pelajaran_id');

            $table->string('nama_mapel', 100);
            $table->string('kode_mapel', 20)->nullable();

            $table->unsignedBigInteger('ms_jenjang_id');

            $table->unsignedInteger('urutan')->default(1);

            $table->text('deskripsi')->nullable();

            $table->enum('status', ['AKTIF', 'NONAKTIF'])
                  ->default('AKTIF');

            $table->timestamps();
            $table->softDeletes();

            // Index
            $table->index('ms_jenjang_id');
            $table->index('status');
        });
    }

    public function down()
    {
        Schema::dropIfExists('ms_mata_pelajaran');
    }
};
