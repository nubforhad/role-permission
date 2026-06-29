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
        Schema::create('deposit_categories', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('installment_type_id')->nullable()->constrained()->nullOnDelete();

            $table->string('name');                 // DPS, FDR, Savings
            $table->string('code')->unique();       // DPS001

            $table->decimal('interest_rate', 5, 2)->default(0);

            $table->enum('deposit_type', [
                'daily',
                'weekly',
                'monthly',
                'fixed',
                'savings'
            ]);

            $table->integer('duration')->nullable();     // 12
            $table->enum('duration_type', [
                'day',
                'week',
                'month',
                'year'
            ])->nullable();

            $table->decimal('minimum_amount', 12, 2)->default(0);
            $table->decimal('maximum_amount', 12, 2)->nullable();

            $table->tinyInteger('status')->default(1);

            $table->text('description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deposit_categories');
    }
};
