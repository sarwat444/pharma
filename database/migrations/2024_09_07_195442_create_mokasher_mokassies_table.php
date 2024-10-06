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
        Schema::create('mokasher_mokassies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable() ;
            $table->foreignId('mayear_mokassy_id')->constrained('mayear_mokassies')->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('mokasher_mokassies');
    }
};
