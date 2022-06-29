<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('emi_amount')->nullable();
            $table->string('emi_amount_id')->nullable();
            $table->string('payment_screenshot')->nullable();
            $table->boolean('status')->default(1);
            $table->boolean('is_verified')->default(0);
            $table->boolean('is_not_verified')->default(0);
            $table->boolean('first_payment')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
