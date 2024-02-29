<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationsTable extends Migration
{
    public function up()
    {
        Schema::create('donations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('donor_id');
            $table->foreign('donor_id')->references('id')->on('customers')->onDelete('cascade');
            $table->decimal('amount', 10, 2)->nullable();
            $table->string('charity_type');
            $table->unsignedBigInteger('charity_id');
            $table->foreign('charity_id')->references('id')->on('fundraisers')->onDelete('cascade');
            $table->integer('no_of_items')->nullable();
            $table->enum('status', ['Pending', 'Completed'])->default('Pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('donations');
    }
}

