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
    Schema::create('bills', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('name'); // Contoh: Allo, Yup, Kosan
        $table->decimal('amount', 15, 2); // Jumlah tagihan default
        $table->integer('due_date')->nullable(); // Tanggal jatuh tempo (misal: tgl 1, tgl 17)
        $table->string('frequency')->default('monthly'); // monthly, weekly, one_time
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
