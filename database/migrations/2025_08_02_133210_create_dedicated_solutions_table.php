<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDedicatedSolutionsTable extends Migration
{
    public function up()
    {
        Schema::create('dedicated_solutions', function (Blueprint $table) {
            $table->id();
            $table->string('caption');
            $table->string('title');
            $table->text('description');
            $table->string('image')->nullable();
            $table->string('video_url')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dedicated_solutions');
    }
}
