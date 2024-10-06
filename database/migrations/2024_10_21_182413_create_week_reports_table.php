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
        Schema::create('week_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teaching_output_id')->constrained('teaching_outputs')->cascadeOnDelete()->cascadeOnUpdate() ;
            $table->foreignId('matarial_id')->constrained('matarials')->cascadeOnDelete()->cascadeOnUpdate() ;
            $table->tinyInteger('execution')->default(0) ;
            $table->string('innvoice')->nullable() ;
            $table->foreignId('added_by')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate() ;
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
        Schema::dropIfExists('week_reports');
    }
};
