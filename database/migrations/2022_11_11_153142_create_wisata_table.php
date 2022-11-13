<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWisataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wisata', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('code_desa', 10);
            $table->string('name');
            // $table->string('thumbnail');
            $table->string('meta_description')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->string('location');
            $table->string('price');
            $table->text('description');
            $table->float('latitude',9,6);
            $table->float('longtitude',9,6);
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
        Schema::dropIfExists('wisatas');
    }
}
