<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKynhansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kynhan', function (Blueprint $table) {
            $table->id();
            $table->integer('id_van_ban')->length(15);
            $table->integer('id_van_ban_nhan')->length(15);
            $table->integer('id_don_vi')->length(15);
            $table->string('nguoi_nhan',100)->nullable();
            $table->string('sdt',50)->nullable();
            $table->string('ngay_nhan',50)->nullable();
            $table->string('gio_nhan',50)->nullable();
            $table->integer('ky_nhan')->length(2)->nullable();
            $table->integer('trang_thai')->length(2)->nullable();
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
        Schema::dropIfExists('kynhan');
    }
}
