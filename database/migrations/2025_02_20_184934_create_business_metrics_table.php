<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessMetricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_metrics', function (Blueprint $table) {
            $table->id();
            $table->text('description')->nullable();
            $table->foreignId('business_id')->constrained('businesses')->onDelete('cascade');
            $table->foreignId('metrics_id')->constrained('metrics')->onDelete('cascade');
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
        Schema::dropIfExists('business_metrics');
    }
}