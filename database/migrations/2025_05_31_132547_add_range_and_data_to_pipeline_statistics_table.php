<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePipelineStatisticsTable extends Migration
{
    public function up()
    {
        Schema::create('pipeline_statistics', function (Blueprint $table) {
            $table->id();
            $table->string('range');
            $table->json('data');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pipeline_statistics');
    }
}
