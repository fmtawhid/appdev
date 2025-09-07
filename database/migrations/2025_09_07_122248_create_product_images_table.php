<?php

// database/migrations/xxxx_xx_xx_create_product_images_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('image');       // Image path
            $table->string('alt_text')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('product_images');
    }
};
