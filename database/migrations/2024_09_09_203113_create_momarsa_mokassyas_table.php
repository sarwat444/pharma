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
        Schema::create('momarsa_mokassyas', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->foreignId('mokasher_id')->constrained('mokasher_mokassies')->cascadeOnUpdate()->cascadeOnDelete() ;
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
        Schema::dropIfExists('momarsa_mokassyas');
    }
};
