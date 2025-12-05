<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('borrowings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // users table
            $table->foreignId('book_id')->constrained('books')->onDelete('cascade');
            $table->timestamp('issued_at')->nullable();
            $table->timestamp('returned_at')->nullable();
            $table->enum('status', ['issued','returned'])->default('issued');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('borrowings');
    }
};
