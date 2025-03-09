<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metrics', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->date('date');
            $table->string('trend')->default('neutral');
            $table->string('value')->default('0');
            $table->string('change')->default('+0');
            $table->boolean('favorite')->default(false);
            $table->string('status')->default('warning');
            $table->text('notes')->nullable();
            $table->decimal('change_percentage', 5, 2)->default(0);
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
        Schema::dropIfExists('metrics');
    }
}