<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penggunaan_lahan', function (Blueprint $table) {
            $table->increments('id');
            $table->geometry('geom')->nullable();
            $table->bigInteger('objectid')->nullable();
            $table->string('remark', 250)->nullable();
            $table->string('srs_id', 50)->nullable();
            $table->string('lcode', 50)->nullable();
            $table->float('shape_leng', null, 0)->nullable();
            $table->float('shape_le_1', null, 0)->nullable();
            $table->float('shape_area', null, 0)->nullable();
            $table->string('image', 50)->nullable();
            $table->string('description', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penggunaan_lahan');
    }
};
