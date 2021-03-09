<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoanReturnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_returns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('header_id');
            $table->foreign('header_id')->references('id')->on('borrow_headers');
            $table->date('tgl_kembali');
            $table->double('keterlambatan');
            $table->double('denda')->default(0);
            $table->double('denda_lainnya')->default(0);
            $table->string('keterangan', 100)->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->bigInteger('new_id')->nullable();
            $table->bigInteger('edit_id')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('loan_returns');
    }
}
