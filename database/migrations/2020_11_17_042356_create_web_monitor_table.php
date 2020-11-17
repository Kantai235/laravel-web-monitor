<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateWebMonitorTable.
 */
class CreateWebMonitorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('web_monitor', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('ip_address')->nullable();
            $table->string('domain')->nullable();
            $table->integer('port')->default(80);
            $table->integer('ping')->nullable();
            $table->unsignedTinyInteger('active')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('web_monitor_history', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('monitor_id');
            $table->integer('ping')->nullable();
            $table->unsignedTinyInteger('active')->default(1);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('monitor_id')
                ->references('id')
                ->on('web_monitor')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('web_monitor_history');
        Schema::dropIfExists('web_monitor');
    }
}
