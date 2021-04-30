<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->integer('credit_points');
            $table->boolean('even_semester');
            $table->boolean('existsOnA');
            $table->boolean('existsOnB');
            $table->boolean('existsOnC');
            $table->boolean('optionalOnA');
            $table->boolean('optionalOnB');
            $table->boolean('optionalOnC');
            $table->string('url');
            $table->boolean('is_accepted');
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
        Schema::dropIfExists('subjects');
    }
}
