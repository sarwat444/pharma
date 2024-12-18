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
        Schema::create('momarsat_files', function (Blueprint $table) {
            $table->id();
            $table->string('file')->nullable() ;
            $table->foreignId('momarsa_id')->constrained('momarsas')->cascadeOnUpdate()->cascadeOnDelete() ;
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
        Schema::dropIfExists('momarsat_files');
    }
};
