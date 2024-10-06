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
        Schema::create('rating_momarsa_mokassies', function (Blueprint $table) {
            $table->id();
            $table->integer('rate') ;
            $table->foreignId('momarsa_id')->constrained('momarsa_mokassyas')->cascadeOnUpdate()->cascadeOnDelete() ;
            $table->text('notes')->nullable() ;
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
        Schema::dropIfExists('rating_momarsa_mokassies');
    }
};
