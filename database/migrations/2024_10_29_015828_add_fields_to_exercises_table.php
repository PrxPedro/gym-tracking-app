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
        $table->string('last_set_intensity')->nullable();
        $table->string('technique')->nullable();
        $table->integer('warm_up_sets')->nullable();
        $table->integer('working_sets')->nullable();
        $table->integer('set_1')->nullable();
        $table->integer('set_2')->nullable();
        $table->integer('set_3')->nullable();
        $table->string('substitution_option_1')->nullable();
        $table->text('notes')->nullable();
    });
}

public function down()
{
    Schema::table('exercises', function (Blueprint $table) {
        $table->dropColumn([
            'last_set_intensity',
            'technique',
            'warm_up_sets',
            'working_sets',
            'set_1',
            'set_2',
            'set_3',
            'substitution_option_1',
            'notes'
        ]);
    });
}

};
