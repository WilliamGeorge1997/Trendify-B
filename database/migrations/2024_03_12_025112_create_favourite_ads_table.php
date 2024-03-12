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
        Schema::create('favourite_ads', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('ad_id');
            $table->foreign('user_id')-> references('id')-> on('users')->constrained()->onDelete('cascade');
            $table->foreign('ad_id')-> references('id')-> on('ads')->constrained()->onDelete('cascade');
            $table->primary(['user_id', 'ad_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favourite_ads');
    }
};
