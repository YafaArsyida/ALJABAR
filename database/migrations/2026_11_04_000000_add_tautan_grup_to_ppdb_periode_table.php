<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('ppdb_periode', 'tautan_grup')) {
            Schema::table('ppdb_periode', function (Blueprint $table) {
                $table->string('tautan_grup', 2048)->nullable();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('ppdb_periode', 'tautan_grup')) {
            Schema::table('ppdb_periode', function (Blueprint $table) {
                $table->dropColumn('tautan_grup');
            });
        }
    }
};
