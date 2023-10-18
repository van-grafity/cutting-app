<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fabric_requisitions', function (Blueprint $table) {
            $table->boolean('status_print')->default(false)->after('laying_planning_detail_id');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fabric_requisitions', function (Blueprint $table) {
            $table->dropColumn('status_print');
        });
    }
};
