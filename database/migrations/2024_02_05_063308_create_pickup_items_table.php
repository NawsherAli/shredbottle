<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePickupItemsTable extends Migration
{
    public function up()
    {
        Schema::create('pickup_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pickup_id')->constrained('pickups');
            $table->string('items_type')->nullable();;
            $table->integer('no_of_bags')->nullable();;
            $table->integer('no_of_boxes')->nullable();;
            $table->integer('req_no_boxes')->nullable();;
            $table->integer('quantity')->nullable();;
            $table->decimal('amount', 10, 2)->nullable();;
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pickup_items');
    }
}
