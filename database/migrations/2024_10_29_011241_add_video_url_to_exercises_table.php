<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('exercises', function (Blueprint $table) {
        $table->string('video_url')->nullable()->after('name');
    });
}

public function down()
{
    Schema::table('exercises', function (Blueprint $table) {
        $table->dropColumn('video_url');
    });
}

};
