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
        Schema::create('syarat_pengajuans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("jenis_dokumen_id")->unsigned();
            $table->string("nama_syarat");
            $table->enum("tipe", ["gambar", "pdf"]);
            $table->boolean("wajib");

            $table->foreign("jenis_dokumen_id")->references('id')->on('jenis_dokumens')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('syarat_pengajuans');
    }
};
