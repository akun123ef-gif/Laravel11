<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('kasir_name');
            $table->unsignedBigInteger('total')->default(0);
            $table->unsignedBigInteger('dibayarkan')->default(0);
            $table->unsignedBigInteger('kembalian')->default(0);
            $table->enum('status', ['pending', 'completed'])->default('pending');
            $table->timestamps();
            $table->index('status');
        });
    }
    public function down(): void { Schema::dropIfExists('transaksis'); }
};
