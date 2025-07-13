<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('nisn');
            $table->longText('alamat');
            $table->unsignedBigInteger('id_kelas');
            $table->unsignedBigInteger('id_angkatan');
            $table->unsignedBigInteger('id_user');
            $table->timestamps();

            $table->foreign('id_kelas')->references('id')->on('kelas');
            $table->foreign('id_angkatan')->references('id')->on('angkatans');
            $table->foreign('id_user')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
