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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name');
            $table->string('name_id');
            $table->string('icon')->nullable();
            $table->text('description_id')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('name');
            $table->index('name_id');
            $table->index('slug');
            $table->index('created_at');
        });

        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('name');
            $table->index('slug');
            $table->index('created_at');
        });

        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content')->nullable();
            $table->string('image')->nullable();
            $table->string('author')->nullable();
            $table->string('category_id')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->enum('status', ['draft', 'active', 'closed', 'expired'])
                ->default('active');
            $table->timestamps();
            $table->softDeletes();

            $table->index('status');
            $table->index('title');
            $table->index('slug');
            $table->index('created_at');
            $table->index('published_at');
            $table->index('category_id');
        });

        Schema::create('news_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('news_id')->constrained('news')->onDelete('cascade');
            $table->foreignId('tag_id')->constrained('tags')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['news_id', 'tag_id']);
            $table->index('news_id');
            $table->index('tag_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_tags');
        Schema::dropIfExists('news');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('categories');
    }
};
