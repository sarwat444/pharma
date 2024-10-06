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
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->foreignId('college_id')->constrained('medicines')->cascadeOnDelete()->cascadeOnUpdate();
            $table->tinyInteger('super_admin')->default(0) ;
            $table->integer('program_id')->nullable() ;
            $table->integer('type')->default(0) ;
            $table->integer('mayear_id')->nullable() ;
            $table->integer('matrial_id')->nullable() ;
            $table->rememberToken();
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
        Schema::dropIfExists('admins');
    }
};
