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
        Schema::create('matarial_descriptions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('week_number')->nullable();
            $table->tinyInteger('type')->default(0);
            $table->text('educaion_output')->nullable();
            $table->text('matarial_content')->nullable();
            $table->string('educaion_method')->nullable();
            $table->string('time')->nullable();
            $table->string('takwem_methods')->nullable();
            $table->string('innvoice')->nullable();
            $table->foreignId('matarial_id')->constrained('matarials')->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('matarial_descriptions');
    }
};
