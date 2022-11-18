<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUmkmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('umkm', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('code_desa', 10);
            $table->unsignedBigInteger('umkm_id');
            $table->string('meta_description')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->string('name');
            $table->string('location');
            $table->string('type_umkm');
            $table->string('contact');
            $table->text('description');
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
        Schema::dropIfExists('umkm');
    }
}
