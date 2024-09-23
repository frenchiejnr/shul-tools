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
        //
        Schema::table('shul_members', function (Blueprint $table) {
            $table->string('fathers_hebrew_name')->default('tatte');
            $table->string('paternal_grandfather_hebrew_name')->default('tatte tatte');
            $table->string('paternal_grandmother_hebrew_name')->default('tatte mamme');
            $table->string('mothers_hebrew_name')->default('mamme');
            $table->string('maternal_grandfather_hebrew_name')->default('mamme tatte');
            $table->string('maternal_grandmother_hebrew_name')->default('mamme mamme');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
