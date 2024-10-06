<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matarials', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->tinyInteger('type')->default(0);
            $table->string('name')->nullable();
            $table->integer('units')->nullable();
            $table->integer('nazary')->nullable();
            $table->integer('tamren')->nullable();
            $table->integer('amaly')->nullable();
            $table->string('team')->nullable();
            $table->string('section')->nullable();
            $table->foreignId('program_id')->constrained('programs')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matarials');
    }
};
