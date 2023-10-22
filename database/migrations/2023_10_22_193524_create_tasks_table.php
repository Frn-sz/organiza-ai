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
        Schema::create('priorityTypes', function (Blueprint $table) {
            $table->id();
            $table->string('type');
        });

        Schema::create('statusTypes', function (Blueprint $table) {
            $table->id();
            $table->string('status');
        });

        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->date('date');
            $table->time('time');
            $table->bigInteger('status')->unsigned();
            $table->bigInteger('priority')->unsigned();
            $table->foreign('priority')->references('id')->on('priorityTypes');
            $table->foreign('status')->references('id')->on('statusTypes');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('priorityTypes');
        Schema::dropIfExists('statusTypes');
    }
};
