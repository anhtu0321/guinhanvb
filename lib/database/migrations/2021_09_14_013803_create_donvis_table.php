<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonvisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donvi', function (Blueprint $table) {
            $table->id();
            $table->string('ten_phong');
            $table->string('ky_hieu');
            $table->string('mat_khau');
            $table->integer('khoi');
            $table->integer('thu_tu');
            $table->integer('trang_thai');
            $table->softDeletes();
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
        Schema::dropIfExists('donvi');
    }
}
