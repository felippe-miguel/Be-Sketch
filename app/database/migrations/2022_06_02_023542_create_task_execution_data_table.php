<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('task_execution_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained();
            $table->boolean('is_done');
            $table->dateTime('datetime');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('task_execution_datas');
    }
};
