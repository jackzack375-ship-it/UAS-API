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
        Schema::create('hoax_checks', function (Blueprint $table) {
    $table->id();
    $table->foreignId('news_history_id')->constrained()->onDelete('cascade');
    $table->float('clickbait_score');
    $table->float('provocation_score');
    $table->float('source_credibility');
    $table->text('summary');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hoax_checks');
    }
};
