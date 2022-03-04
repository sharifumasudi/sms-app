<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSentsmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sentsms', function (Blueprint $table) {
            $table->bigIncrements('sentsms_id')->from(40000);
            $table->foreignId('sender_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('receiver_id')->references('sms_receiver_id')->on('sms_receiver')->cascadeOnUpdate()->cascadeOnDelete();
            $table->text('sms_description');
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
        Schema::dropIfExists('sentsms');
    }
}
