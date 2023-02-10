<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->string('service_name');
            $table->timestamp('date_time');
            $table->string('rest_type');
            $table->string('route');
            $table->string('http_version');
            $table->integer('status_code');
            $table->integer('file_row_number');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(array('date_time', 'file_row_number'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
}
