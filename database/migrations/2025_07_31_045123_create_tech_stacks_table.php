<?php

// database/migrations/xxxx_xx_xx_create_tech_stacks_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tech_stacks', function (Blueprint $table) {
            $table->id();
            $table->string('platform');
            $table->string('stack_name');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('programming_language_tech_stack', function (Blueprint $table) {
            $table->foreignId('tech_stack_id')->constrained()->onDelete('cascade');
            $table->foreignId('programming_language_id')->constrained()->onDelete('cascade');
            $table->primary(['tech_stack_id', 'programming_language_id']);
        });
    }

    public function down(): void {
        Schema::dropIfExists('programming_language_tech_stack');
        Schema::dropIfExists('tech_stacks');
    }
};
