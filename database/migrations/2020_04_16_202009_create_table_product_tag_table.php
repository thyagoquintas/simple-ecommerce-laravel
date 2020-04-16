<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableProductTagTable extends Migration
{

    public function up()
    {
        Schema::create('product_tag', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('product_id');
            $table->integer('tag_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_tag');
    }
}
