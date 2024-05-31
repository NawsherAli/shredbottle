<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('request_id')->unique()->default(Str::random(8));
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('fundraiser_id')->nullable();
            $table->string('type')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->string('transaction_no')->nullable();
            $table->date('request_date');
            $table->date('transaction_date')->nullable();
            $table->string('e_transfer_no');
            $table->enum('status', ['Pending', 'Completed'])->default('Pending');
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->foreign('fundraiser_id')->references('id')->on('fundraisers')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}

