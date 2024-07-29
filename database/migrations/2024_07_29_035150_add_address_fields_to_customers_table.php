<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAddressFieldsToCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('unit_number')->nullable()->after('address'); // Adjust 'existing_column' to the column after which you want to add this field
            $table->string('street_address')->nullable()->after('unit_number');
            $table->string('city')->nullable()->after('street_address');
            $table->string('province')->nullable()->after('city'); // Storing province code (e.g., ON, BC)
            $table->string('postal_code', 7)->nullable()->after('province'); // Canadian postal code format
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn('unit_number');
            $table->dropColumn('street_address');
            $table->dropColumn('city');
            $table->dropColumn('province');
            $table->dropColumn('postal_code');
        });
    }
}
