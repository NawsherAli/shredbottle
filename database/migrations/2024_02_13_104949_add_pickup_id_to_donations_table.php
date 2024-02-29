<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPickupIdToDonationsTable extends Migration
{
    public function up()
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->unsignedBigInteger('pickup_id')->nullable();
            $table->foreign('pickup_id')->references('id')->on('pickups')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('donations', function (Blueprint $table) {
            $table->dropForeign(['pickup_id']);
            $table->dropColumn('pickup_id');
        });
    }
}
