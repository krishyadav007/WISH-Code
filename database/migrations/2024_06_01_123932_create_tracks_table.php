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
        Schema::create('tracks', function (Blueprint $table) {
            $table->id();
            $table->string("cover");
            $table->string("slug");
            $table->string("title");
            $table->string("subtitle");
            $table->longText("about");
            $table->longText('pictures');
            $table->string('chair');
            $table->longText('members');
            $table->longText('reports');
            $table->longText('events');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tracks');
    }
};
