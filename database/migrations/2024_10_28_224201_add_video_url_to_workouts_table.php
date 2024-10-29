<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVideoUrlToWorkoutsTable extends Migration
{
    public function up()
    {
        Schema::table('workouts', function (Blueprint $table) {
            $table->string('video_url')->nullable()->after('description');
        });
    }

    public function down()
    {
        Schema::table('workouts', function (Blueprint $table) {
            $table->dropColumn('video_url');
        });
    }
}
