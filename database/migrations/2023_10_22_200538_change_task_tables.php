<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('task_priority', function (Blueprint $table) {
            $table->id();
            $table->string('priority');
            $table->timestamps();
        });

        Schema::create('task_status', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->timestamps();
        });

        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('description');
            $table->date('date');
            $table->time('time');
            $table->bigInteger('status_id')->unsigned();
            $table->bigInteger('priority_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('priority_id')->references('id')->on('task_priority');
            $table->foreign('status_id')->references('id')->on('task_status');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('task_priority');
        Schema::dropIfExists('task_status');
    }
};
