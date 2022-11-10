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
        Schema::create('clase_user', function (Blueprint $table) {
            $table->foreignId('clase_id')->constrained('clases');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
            $table->primary(['clase_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clase_user');
    }
};
