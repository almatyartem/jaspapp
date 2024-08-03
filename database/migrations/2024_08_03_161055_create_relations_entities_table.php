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
        Schema::create('relations_entities', function (Blueprint $table) {
            $table->foreignId('entity_id')->constrained('entities')->cascadeOnDelete();
            $table->foreignId('relation_id')->constrained('relations')->cascadeOnDelete();
            $table->boolean('is_main')->default(false);
            $table->unique(['entity_id', 'relation_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relations_entities');
    }
};
