<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_details', function (Blueprint $table) {
            $table->id();
            $table->string('bank_name')->nullable();
            $table->enum('static_id',[1]);
            $table->string('branch_name')->nullable();
            $table->string('branch_code')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->string('bank_aaccount_no')->nullable();
            $table->string('bank_aaccount_holder_name')->nullable();
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('bank_details');
    }
}
