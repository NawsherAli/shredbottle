<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pickup_item_id')->constrained('pickup_items');
            $table->string('item_type');
            $table->string('item_size');
            $table->integer('item_quantity');
            $table->decimal('item_amount', 8, 2); // Adjust precision and scale as needed
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items_details');
    }
}
