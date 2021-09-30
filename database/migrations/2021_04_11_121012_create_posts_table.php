<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('description', 5000);
            $table->string('phoneNumber');
            $table->string('country');
            $table->string('city');
            $table->integer('zipcode');
            $table->string('address');
            $table->string('lat');
            $table->string('lng');
            $table->string('deal');
            $table->string('type');
            $table->string('condition');
            $table->integer('surface');
            $table->integer('price');
            $table->string('first_image_path');
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
        Schema::dropIfExists('posts');
    }
}
