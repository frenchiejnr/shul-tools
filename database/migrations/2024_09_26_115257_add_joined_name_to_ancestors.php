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

            $table->string('father_full_name')->virtualAs('fathers_hebrew_name || \' ben \' || paternal_grandfather_hebrew_name');
            $table->string('mother_full_name')->virtualAs('mothers_hebrew_name || \' bas \' || maternal_grandfather_hebrew_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ancestors', function (Blueprint $table) {

            $table->dropColumn('father_full_name');
            $table->dropColumn('mother_full_name');
        });
    }
};
