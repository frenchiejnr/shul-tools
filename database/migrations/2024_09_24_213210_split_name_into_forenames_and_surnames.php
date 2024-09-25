<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('shul_members', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->string('forenames')->nullable()->after('id');
            $table->string('surname')->nullable()->after('forenames');
        });
    }

    public function down()
    {
        Schema::table('your_table_name', function (Blueprint $table) {
            $table->dropColumn('forenames');
            $table->dropColumn('surnames');
            $table->string('name')->nullable();
        });
    }
};
