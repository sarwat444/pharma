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
        Schema::create('innvoices', function (Blueprint $table) {
            $table->id();
            $table->integer('week_number')->nullable() ;
            $table->string('name')->nullable() ;
            $table->string('file_path')->nullable() ;
            $table->foreignId('added_by')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('matarial_id')->constrained('matarials')->cascadeOnDelete()->cascadeOnUpdate();
            $table->enum('main_type', ['map', 'week_report']);
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
        Schema::dropIfExists('innvoices');
    }
};
