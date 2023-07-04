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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->enum("status", ["local", "non-local"])->default("non-local");
            $table->string("fullname");
            $table->string("nik", 16)->unique(); 
            $table->integer("age")->nullable(); 
            $table->date("date_of_birth")->nullable(); 
            $table->string("place_of_birth")->nullable(); 
            $table->string("address"); 
            $table->string("phone"); 
            $table->bigInteger("user_id")->unsigned();

            $table->foreign("user_id")->references("id")->on("users")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
