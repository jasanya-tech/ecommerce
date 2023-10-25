<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('invoice')->unique();
            $table->string('no_resi')->unique()->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreignId('payment_id')->nullable()->constrained('payments')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->string('address');
            $table->string('payment_proof')->nullable();
            $table->text('additional_note');
            $table->integer('total');
            $table->string('status');
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
        Schema::dropIfExists('orders');
    }
};
