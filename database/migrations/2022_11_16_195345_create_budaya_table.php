<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBudayaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('budaya', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('code_desa', 10);
            $table->unsignedBigInteger('budaya_id');
            $table->string('meta_description')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->string('name');
            $table->text('location');
            $table->string('figure');
            $table->string('contact');
            $table->string('type_budaya');
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
        Schema::dropIfExists('budayas');
    }
}
