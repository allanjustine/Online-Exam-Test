<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEssay extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('essay', function (Blueprint $table) {
            $table->increments('id');
            $table->smallInteger('topic_id');
            $table->integer('user_id');
            $table->text('situation')->nullable();
            $table->text('answer')->nullable();
            $table->integer('mark')->default(0);
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
        Schema::dropIfExists('essay');
    }
}
