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
        Schema::create('submissions', function (Blueprint $table) {
            $table->id();
            $table->string("admin_note")->nullable();
            $table->datetime("pick_up_date")->nullable();
            $table->boolean("is_softcopy")->default(false);
            $table->string("name");
            $table->string("file");
            $table->string('soft_copy')->nullable();
            $table->text("description");
            $table->enum("status", ["menunggu konfirmasi", "diterima", "ditolak", "butuh revisi", "dibatalkan"]);
            $table->bigInteger("jenis_document_id")->unsigned();
            $table->bigInteger("user_id")->unsigned();

            $table->foreign("jenis_document_id")->references("id")->on("jenis_documents")->onDelete("cascade");
            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submissions');
    }
};
