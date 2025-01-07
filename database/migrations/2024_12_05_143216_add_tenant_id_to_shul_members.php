<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddTenantIdToShulMembers extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('shul_members', function (Blueprint $table) {
            $table->foreignId('tenant_id')->nullable()->constrained()->onDelete('cascade');
        });

        DB::table('shul_members')->update(['tenant_id' => 2]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shul_members', function (Blueprint $table) {
            //
            $table->dropForeign('shul_members_tenant_id_foreign');
            $table->dropColumn('tenant_id');
        });
    }
};
