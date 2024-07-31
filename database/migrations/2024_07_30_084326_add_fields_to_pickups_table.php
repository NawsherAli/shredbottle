<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToPickupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pickups', function (Blueprint $table) {
            $table->string('unit_number')->nullable()->after('amount');
            $table->string('street_address')->nullable()->after('unit_number');
            $table->string('city')->nullable()->after('street_address');
            $table->string('province')->nullable()->after('city');
            $table->string('postal_code')->nullable()->after('province');
            $table->text('special_instructions')->nullable()->after('postal_code');
            $table->enum('show_info', ['No', 'Yes'])->nullable()->default(null)->after('special_instructions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pickups', function (Blueprint $table) {
            $table->dropColumn([
                'unit_number', 
                'street_address', 
                'city', 
                'province', 
                'postal_code', 
                'special_instructions', 
                'show_info'
            ]);
        });
    }
}
