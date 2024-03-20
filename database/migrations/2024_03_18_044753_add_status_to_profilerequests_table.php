<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToProfilerequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profilerequests', function (Blueprint $table) {
            $table->string('status')->default('pending'); // Assuming status is a string with a default value of 'pending'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('profilerequests', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
