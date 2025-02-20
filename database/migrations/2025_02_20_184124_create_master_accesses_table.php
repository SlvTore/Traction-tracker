<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterAccessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_accesses', function (Blueprint $table) {
            $table->id('master_access_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('status')->default(1); // 1 = aktif, 0 = non aktif
            $table->timestamps();
            $table->integer('created_id')->nullable();
            $table->integer('update_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_accesses');
    }
}