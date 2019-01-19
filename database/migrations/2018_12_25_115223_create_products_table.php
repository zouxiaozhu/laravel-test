<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',128)->comment('产品名称');
            $table->string('url',20)->comment('产品url');
            $table->string('android_url')->comment('安卓下载链接');
            $table->string('ios_url')->comment('苹果下载链接');
            $table->tinyInteger('status')->default(0)->comment('是否上线');
            $table->Integer('sort')->default(0)->comment('排序');
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
        Schema::dropIfExists('products');
    }
}
