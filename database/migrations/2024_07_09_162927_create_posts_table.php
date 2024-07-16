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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->integer("available_seats");
            $table->string("eligibility_criteria");
            $table->json("types");
            $table->string("address");
            $table->dateTimeTz("date", precision: 0);
            $table->string("city");

//            $table->decimal("lat");
//            $table->decimal("lng");
            $table->timestamps();

//            $table->integer("user_id");
            $table->foreignId('user_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
