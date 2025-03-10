<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMetricRecordsTable extends Migration
{
    public function up()
    {
        Schema::create('metric_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('metric_id')->constrained()->onDelete('cascade');
            $table->string('value');
            $table->string('status');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('metric_records');
    }
}
