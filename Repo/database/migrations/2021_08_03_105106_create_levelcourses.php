<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLevelcourses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('levelcourses', function (Blueprint $table) {
            $table->unsignedBigInteger('course');
            $table->foreign('course')->references('id')->on('courses')->onDelete('cascade')->onUpdate('cascade');
            $table->string('Level');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropForeign('levelcourses_course_foreign');
        $table->dropIndex('levelcourses_course_index');
        $table->dropColumn('course');
        Schema::dropIfExists('levelcourses');
    }
}
