<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('nip')->unique()->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->integer('role_id')->default('1');
            $table->integer('nama_unit')->nullable();
            $table->integer('darkMode')->default('0');
            $table->integer('openSideBar')->default('1');
            $table->string('password')->default('$2y$10$JUUKFmyB9pWCIAcTjC12QOT5XdV7t8peTA3.zbNvaUUj.pwGwBVq.');
            $table->timestamp('email_verified_at')->nullable();
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
        Schema::dropIfExists('users');
    }
}
