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
        Schema::create('special_terms', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("jenis_document_id")->unsigned();
            $table->string("name");
            $table->enum("type", ["image", "pdf", "text"]);

            $table->foreign("jenis_document_id")->references("id")->on("jenis_documents")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('special_terms');
    }
};
