<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToProfilerequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('profilerequests', function (Blueprint $table) {
            $table->enum('tax_slip_confirmation', ['Yes', 'No'])->default('Yes');
            $table->string('vision')->nullable();
            $table->string('unit_number')->nullable();
            $table->string('street_address')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('postal_code')->nullable();
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
            $table->dropColumn('tax_slip_confirmation');
            $table->dropColumn('vision');
            $table->dropColumn('unit_number');
            $table->dropColumn('street_address');
            $table->dropColumn('city');
            $table->dropColumn('province');
            $table->dropColumn('postal_code');
        });
    }
}
