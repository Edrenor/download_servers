<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->id();
            $table->string('provider')->nullable();
            $table->string('brand')->nullable();
            $table->string('location')->nullable();
            $table->string('cpu')->nullable();
            $table->integer('drive')->nullable();
            $table->integer('price')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('datacenter')->nullable();
            $table->string('brand_label')->nullable();
            $table->string('model')->nullable();
            $table->integer('core')->nullable();
            $table->integer('ram')->nullable();
            $table->string('drive_label')->nullable();
            $table->string('bandwidth')->nullable();
            $table->integer('ip')->nullable();
            $table->integer('show_bw')->nullable();
            $table->date('sell_out_start')->nullable();
            $table->date('sell_out_end')->nullable();
            $table->integer('discount')->nullable();
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
        Schema::dropIfExists('servers');
    }
}
