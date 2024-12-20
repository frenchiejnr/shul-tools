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
        Schema::table('ancestors', function (Blueprint $table) {
            $table->enum('maternal_status', ['kohen', 'levi', 'yisrael'])->default('yisrael');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ancestors', function (Blueprint $table) {
            $table->dropColumn('maternal_status');
        });
    }
};
