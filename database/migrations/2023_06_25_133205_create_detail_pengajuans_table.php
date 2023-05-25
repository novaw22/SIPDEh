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
        Schema::create('detail_pengajuans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("pengajuan_id")->unsigned();
            $table->bigInteger("syarat_pengajuan_id")->unsigned();
            $table->string("konten");

            $table->foreign("pengajuan_id")->references('id')->on('pengajuans')->onDelete('cascade');
            $table->foreign("syarat_pengajuan_id")->references('id')->on('syarat_pengajuans')->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pengajuans');
    }
};
