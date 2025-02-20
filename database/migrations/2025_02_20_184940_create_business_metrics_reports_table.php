<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessMetricsReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_metrics_reports', function (Blueprint $table) {
            $table->id();
            $table->decimal('value', 15, 2);
            $table->foreignId('business_metrics_id')->constrained('business_metrics')->onDelete('cascade');
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
        Schema::dropIfExists('business_metrics_reports');
    }
}