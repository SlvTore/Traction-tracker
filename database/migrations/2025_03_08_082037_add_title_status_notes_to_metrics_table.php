<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTitleStatusNotesToMetricsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('metrics', function (Blueprint $table) {
            $table->string('title')->nullable()->after('id');  // Menambahkan kolom title
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending')->after('value');  // Menambahkan kolom status
            $table->text('notes')->nullable()->after('status');  // Menambahkan kolom notes
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('metrics', function (Blueprint $table) {
            $table->dropColumn(['title', 'status', 'notes']);  // Menghapus kolom jika rollback
        });
    }
}
