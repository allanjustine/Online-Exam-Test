<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColumnTempquestion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('temp_answers', function (Blueprint $table) {
            $table->dropColumn(['a', 'b', 'c', 'd']);
            $table->text('choices')->after('question')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('temp_answers', function (Blueprint $table) {
            $table->dropColumn('choices');
        });
    }
}
