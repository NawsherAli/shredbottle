<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePickupsTable extends Migration
{
    public function up()
    {
        Schema::create('pickups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers');
            $table->string('pickup_location');
            $table->date('pickup_date');
            $table->string('pickup_contact');
            $table->string('pickup_service');
            $table->string('payment_option');
            $table->string('charity_type')->nullable();
            $table->string('charity_organization')->nullable();;
            $table->enum('status', ['Pending', 'Completed'])->default('Pending');
            $table->string('total_items')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pickups');
    }
}
