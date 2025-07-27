<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserFanTable extends Migration
{
    public function up()
    {
        Schema::create('user_fan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')   // The main user
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->foreignId('fan_id')    // The fan user
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->timestamps();

            $table->unique(['user_id', 'fan_id']); // Prevent duplicates
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_fan');
    }
}
