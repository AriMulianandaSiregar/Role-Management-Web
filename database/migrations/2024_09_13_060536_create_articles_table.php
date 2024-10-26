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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("user_id"); // tambahkan ini agar sebagai foreign key setiap postingan punya user_idnya
            $table->string("title"); //tambahkan ini
            $table->text("body"); //tambahkan ini
            $table->boolean("published")->default(false); //tambahkan ini agar hanya bisa admin yang melakukan published
            $table->timestamps();

            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade"); //buat relasinya disini

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
};
