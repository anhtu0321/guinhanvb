<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVanbanguisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vanbangui', function (Blueprint $table) {
            $table->id();
            $table->string('so',200)->nullable();
            $table->integer('id_loai_van_ban')->length(4)->nullable();
            $table->integer('do_mat')->nullable();
            $table->string('trich_yeu');
            $table->integer('don_vi_gui')->nullable();
            $table->string('ghi_chu')->nullable();
            $table->string('file')->nullable();
            $table->string('ngay_nhap',50);
            $table->string('gio_nhap',50);
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
        Schema::dropIfExists('vanbangui');
    }
}
