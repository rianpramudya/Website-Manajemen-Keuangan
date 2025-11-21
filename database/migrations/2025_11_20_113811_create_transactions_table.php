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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();

            // Relasi ke users
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Relasi ke categories (nullable)
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');

            // Relasi ke bills (nullable) — tambahan baru
            $table->foreignId('bill_id')->nullable()->constrained('bills')->onDelete('set null');

            // Kolom-kolom utama
            $table->string('description')->nullable(); // Contoh: "Nasi Padang", "Bayar Kos"
            $table->decimal('amount', 15, 2);          // Nominal uang
            $table->enum('type', ['income', 'expense']);
            $table->date('date');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
