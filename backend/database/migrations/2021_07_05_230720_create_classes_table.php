<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("school_id");
            $table->integer("year");
            $table->unsignedBigInteger('nivel_id');
            $table->string("serie");
            $table->char("turn", 1);
            $table->timestamps();
            
            $table->foreign("nivel_id")->references("id")->on("educational_levels");
            $table->foreign("school_id")->references("id")->on("schools");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classes');
    }
}
